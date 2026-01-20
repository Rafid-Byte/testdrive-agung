<?php

namespace App\Http\Controllers;

use App\Models\Checksheet;
use App\Models\TestDriveBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CheckSheetController extends Controller
{
    public function index()
    {
        if (session('error') === 'Anda tidak memiliki akses ke halaman tersebut.') {
            session()->forget('error');
        }

        $testDriveBookings = TestDriveBooking::with(['supervisor', 'security', 'checksheet'])
            ->whereNotNull('supervisor_user_id')
            ->orderBy('tanggal_booking', 'desc')
            ->get()
            ->map(function ($booking) {
                $approvalStatus = 'pending';
                $approvalLabel = 'Menunggu';

                if ($booking->isApproved()) {
                    $approvalStatus = 'approved';
                    $approvalLabel = 'Disetujui';
                } elseif ($booking->isNotApproved()) {
                    $approvalStatus = 'not_approved';
                    $approvalLabel = 'Dibatalkan';
                }

                return [
                    'id' => $booking->id,
                    'booking_type' => 'test_drive',
                    'customer' => $booking->nama_lengkap,
                    'phone' => $booking->nomor_telepon,
                    'car' => $booking->mobil_test_drive,
                    'date' => \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y'),
                    'spv' => $booking->supervisor?->name ?? '-',
                    'security' => '-',
                    'status' => $booking->status,
                    'approval_status' => $approvalStatus,
                    'approval_label' => $approvalLabel,
                    'is_approved' => $booking->isApproved(),
                    'has_checksheet' => $booking->hasChecksheet(),
                    'checksheet_id' => $booking->checksheet?->id
                ];
            });

        $bookings = $testDriveBookings;

        return view('checksheet', compact('bookings'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_id' => 'required|exists:test_drive_bookings,id',
                'tanggal_test_drive' => 'required|date',
                'jam_pinjam' => 'required',
                'jam_kembali' => 'required',
                'tipe_mobil' => 'required|string',
                'no_polisi' => 'required|string',
            ]);

            $booking = TestDriveBooking::findOrFail($request->booking_id);

            if ($booking->hasChecksheet()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking ini sudah memiliki checksheet!'
                ], 422);
            }

            if (!$booking->isApproved()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking belum di-approve oleh SPV!'
                ], 422);
            }

            $allowedStatuses = ['Dikonfirmasi', 'Sedang test drive', 'Selesai', 'Perawatan'];
            if (!in_array($booking->status, $allowedStatuses)) {
                $statusMessage = match ($booking->status) {
                    'Menunggu' => 'Booking masih menunggu approval SPV!',
                    'Diproses' => 'Booking masih diproses SPV, menunggu konfirmasi Branch Manager!',
                    'Dibatalkan' => 'Booking sudah dibatalkan!',
                    default => 'Booking belum dikonfirmasi oleh Branch Manager!'
                };

                return response()->json([
                    'success' => false,
                    'message' => $statusMessage
                ], 422);
            }

            DB::beginTransaction();

            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['status'] = 'pending';
            $data['nama_customer'] = $booking->nama_lengkap;

            $checkboxFields = $this->getAllCheckboxFields();
            foreach ($checkboxFields as $field) {
                $data[$field] = filter_var($request->input($field, false), FILTER_VALIDATE_BOOLEAN);
            }

            $checksheet = Checksheet::create($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Check Sheet berhasil disimpan!',
                'data' => $checksheet
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving checksheet: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $checksheet = Checksheet::with(['booking.supervisor', 'booking.security', 'user'])
                ->findOrFail($id);

            $currentUser = Auth::user();

            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized - User not authenticated'
                ], 401);
            }

            $canView = $this->userHasRole($currentUser, ['admin', 'spv', 'security']) ||
                       $checksheet->user_id === $currentUser->id;

            if (!$canView) {
                Log::warning('Unauthorized checksheet access attempt:', [
                    'user_id' => $currentUser->id ?? 'unknown',
                    'user_role' => $currentUser->role ?? 'unknown',
                    'checksheet_id' => $id
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $formData = $checksheet->toArray();
            $checkboxFields = $this->getAllCheckboxFields();

            foreach ($checkboxFields as $field) {
                if (isset($formData[$field])) {
                    $formData[$field] = filter_var($formData[$field], FILTER_VALIDATE_BOOLEAN);
                }
            }

            if (isset($formData['tanggal_test_drive'])) {
                $formData['tanggal_test_drive'] = \Carbon\Carbon::parse($formData['tanggal_test_drive'])->format('Y-m-d');
            }

            if (isset($formData['tanggal_penggantian_pewangi']) && $formData['tanggal_penggantian_pewangi']) {
                $formData['tanggal_penggantian_pewangi'] = \Carbon\Carbon::parse($formData['tanggal_penggantian_pewangi'])->format('Y-m-d');
            }

            Log::info('✅ Checksheet viewed successfully:', [
                'checksheet_id' => $id,
                'viewed_by' => $currentUser->email,
                'user_role' => $currentUser->role
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'booking' => [
                        'id' => $checksheet->booking->id,
                        'customer' => $checksheet->booking->nama_lengkap,
                        'car' => $checksheet->booking->mobil_test_drive,
                        'phone' => $checksheet->booking->nomor_telepon,
                        'spv' => $checksheet->booking->supervisor?->name ?? '-',
                        'security' => $checksheet->booking->security?->name ?? '-',
                    ],
                    'form_data' => $formData
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading checksheet: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Checksheet tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_test_drive' => 'required|date',
                'jam_pinjam' => 'required',
                'jam_kembali' => 'required',
                'tipe_mobil' => 'required|string',
                'no_polisi' => 'required|string',
            ]);

            DB::beginTransaction();

            $checksheet = Checksheet::findOrFail($id);
            $currentUser = Auth::user();

            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized - User not authenticated'
                ], 401);
            }

            if (!$this->userCanAccessChecksheet($currentUser) && $checksheet->user_id !== $currentUser->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $data = $request->all();

            $checkboxFields = $this->getAllCheckboxFields();
            foreach ($checkboxFields as $field) {
                $data[$field] = filter_var($request->input($field, false), FILTER_VALIDATE_BOOLEAN);
            }

            $checksheet->update($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Check Sheet berhasil diperbarui!',
                'data' => $checksheet
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating checksheet: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getChecksheets()
    {
        try {
            $checksheets = Checksheet::with(['booking.supervisor', 'booking.security', 'user'])
                ->latest()
                ->get()
                ->map(function ($checksheet) {
                    $booking = $checksheet->booking;

                    return [
                        'id' => $checksheet->id,
                        'customer' => $checksheet->booking->nama_lengkap,
                        'car' => $checksheet->booking->mobil_test_drive,
                        'date' => \Carbon\Carbon::parse($checksheet->tanggal_test_drive)->format('d F Y'),
                        'jam_pinjam' => $checksheet->jam_pinjam,
                        'jam_kembali' => $checksheet->jam_kembali,
                        'filled_by' => $checksheet->user->name ?? 'Unknown',
                        'filled_by_email' => $checksheet->user->email ?? '-',
                        'security' => $checksheet->booking->security?->name ?? '-',
                        'spv' => $checksheet->booking->supervisor?->name ?? '-',
                        'status' => $booking->isApproved() ? 'approved' : ($booking->isPending() ? 'pending' : 'not_approved'),
                        'status_label' => $booking->isApproved() ? 'Disetujui' : ($booking->isPending() ? 'Menunggu' : 'Dibatalkan'),

                        'created_at' => $checksheet->created_at->format('d F Y H:i')
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $checksheets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat checksheet',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            $checksheetId = $request->get('checksheet_id');

            if ($checksheetId) {
                return $this->exportSingle($checksheetId);
            }

            return $this->exportAll();
        } catch (\Exception $e) {
            Log::error('Error exporting checksheet: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export checksheet: ' . $e->getMessage());
        }
    }

    public function exportSingle($checksheetId)
    {
        try {
            $checksheet = Checksheet::with(['booking.supervisor', 'booking.security', 'user'])
                ->findOrFail($checksheetId);

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->mergeCells('A1:L1');
            $sheet->setCellValue('A1', 'Check Sheet Peminjaman & Pengembalian Unit Test Drive');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');

            $sheet->mergeCells('A2:L2');
            $sheet->setCellValue('A2', 'Agung Toyota Jambi Pal 10');
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $row = 4;

            $sheet->setCellValue('A' . $row, 'Nama Customer:');
            $sheet->setCellValue('B' . $row, $checksheet->nama_customer ?? $checksheet->booking->nama_lengkap);
            $sheet->setCellValue('G' . $row, 'Jam Kembali:');
            $sheet->setCellValue('H' . $row, $checksheet->jam_kembali);

            $row++;
            $sheet->setCellValue('A' . $row, 'Tanggal Test Drive:');
            $sheet->setCellValue('B' . $row, \Carbon\Carbon::parse($checksheet->tanggal_test_drive)->format('d/m/Y'));
            $sheet->setCellValue('G' . $row, 'Tipe Mobil:');
            $sheet->setCellValue('H' . $row, $checksheet->tipe_mobil);

            $row++;
            $sheet->setCellValue('A' . $row, 'Jam Pinjam:');
            $sheet->setCellValue('B' . $row, $checksheet->jam_pinjam);
            $sheet->setCellValue('G' . $row, 'No. Polisi:');
            $sheet->setCellValueExplicit('H' . $row, $checksheet->no_polisi, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

            $row += 2;
            $sheet->mergeCells('A' . $row . ':C' . $row);
            $sheet->setCellValue('A' . $row, 'Kondisi Kendaraan Saat Di Pinjam');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('G' . $row . ':I' . $row);
            $sheet->setCellValue('G' . $row, 'Kondisi Kendaraan Saat Di Kembalikan');
            $sheet->getStyle('G' . $row)->getFont()->setBold(true);
            $sheet->getStyle('G' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');
            $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $row++;
            $sheet->setCellValue('A' . $row, 'Bagian Di Cek');
            $sheet->setCellValue('B' . $row, 'Kondisi');
            $sheet->setCellValue('C' . $row, 'Catatan Kerusakan');
            $sheet->setCellValue('G' . $row, 'Bagian Di Cek');
            $sheet->setCellValue('H' . $row, 'Kondisi');
            $sheet->setCellValue('I' . $row, 'Catatan Kerusakan');

            foreach (['A', 'B', 'C', 'G', 'H', 'I'] as $col) {
                $sheet->getStyle($col . $row)->getFont()->setBold(true);
                $sheet->getStyle($col . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE6E6E6');
            }

            $kondisiItems = [
                'body_luar' => 'Body Luar (baret, penyok)',
                'ban_velg' => 'Ban & Velg',
                'kaca_spion' => 'Kaca & Spion',
                'interior' => 'Interior (kursi, dashboard, karpet)',
                'kebersihan_interior' => 'Kebersihan Interior',
                'peralatan' => 'Peralatan (dongkrak, toolkit, segitiga)',
                'ac_audio' => 'AC & Audio',
                'lampu' => 'Lampu-lampu'
            ];

            $row++;
            foreach ($kondisiItems as $key => $label) {
                $sheet->setCellValue('A' . $row, $label);
                $sheet->setCellValue('B' . $row, $this->getKondisi($checksheet, $key, 'pinjam'));

                $catatanPinjam = $checksheet->{$key . '_pinjam_tidak_baik'}
                    ? ($checksheet->{$key . '_pinjam_catatan'} ?: '-')
                    : '-';
                $sheet->setCellValue('C' . $row, $catatanPinjam);

                $sheet->setCellValue('G' . $row, $label);
                $sheet->setCellValue('H' . $row, $this->getKondisi($checksheet, $key, 'kembali'));

                $catatanKembali = $checksheet->{$key . '_kembali_tidak_baik'}
                    ? ($checksheet->{$key . '_kembali_catatan'} ?: '-')
                    : '-';
                $sheet->setCellValue('I' . $row, $catatanKembali);

                $row++;
            }

            $row++;
            $sheet->mergeCells('A' . $row . ':L' . $row);
            $sheet->setCellValue('A' . $row, 'Bahan Bakar');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');

            $row++;
            $sheet->setCellValue('A' . $row, 'Saat dipinjam:');
            $sheet->setCellValue('B' . $row, $this->getBahanBakar($checksheet, 'pinjam'));
            $sheet->setCellValue('G' . $row, 'Saat Kembali:');
            $sheet->setCellValue('H' . $row, $this->getBahanBakar($checksheet, 'kembali'));

            $row += 2;
            $sheet->mergeCells('A' . $row . ':C' . $row);
            $sheet->setCellValue('A' . $row, 'Dokumen & Kunci Saat Di Pinjam');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');

            $sheet->mergeCells('G' . $row . ':I' . $row);
            $sheet->setCellValue('G' . $row, 'Dokumen & Kunci Saat Di Kembalikan');
            $sheet->getStyle('G' . $row)->getFont()->setBold(true);
            $sheet->getStyle('G' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');

            $dokumenItems = [
                'stnk' => 'STNK',
                'kunci_utama' => 'Kunci Utama',
                'remote_keyless' => 'Remote / Keyless'
            ];

            $row++;
            foreach ($dokumenItems as $key => $label) {
                $sheet->setCellValue('A' . $row, $label);
                $sheet->setCellValue('B' . $row, $this->getDokumenStatus($checksheet, $key, 'pinjam'));
                $sheet->setCellValue('G' . $row, $label);
                $sheet->setCellValue('H' . $row, $this->getDokumenStatus($checksheet, $key, 'kembali'));
                $row++;
            }

            $row++;
            $sheet->mergeCells('A' . $row . ':L' . $row);
            $sheet->setCellValue('A' . $row, 'Kelengkapan Tambahan');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFD966');

            $row++;
            $sheet->setCellValue('A' . $row, 'Air Mineral Botol (Pinjam):');
            $sheet->setCellValue('B' . $row, $this->getDokumenStatus($checksheet, 'air_mineral', 'pinjam'));
            $sheet->setCellValue('G' . $row, 'Air Mineral Botol (Kembali):');
            $sheet->setCellValue('H' . $row, $this->getDokumenStatus($checksheet, 'air_mineral', 'kembali'));

            $row += 2;
            $sheet->setCellValue('A' . $row, 'Tanggal Penggantian Pewangi:');
            $sheet->setCellValue('B' . $row, $checksheet->tanggal_penggantian_pewangi
                ? \Carbon\Carbon::parse($checksheet->tanggal_penggantian_pewangi)->format('d/m/Y')
                : '-');

            $sheet->getColumnDimension('A')->setWidth(30);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(40);
            $sheet->getColumnDimension('G')->setWidth(30);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(40);

            $filename = 'Checksheet_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $checksheet->booking->nama_lengkap) . '_' . date('Y-m-d') . '.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), 'checksheet');
            $writer = new Xlsx($spreadsheet);
            $writer->save($temp_file);

            return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error exporting single checksheet: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export checksheet: ' . $e->getMessage());
        }
    }

    public function exportAll()
    {
        try {
            $checksheets = Checksheet::with(['booking.supervisor', 'booking.security', 'user'])->latest()->get();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $headers = ['A1' => 'No', 'B1' => 'Tanggal', 'C1' => 'Customer', 'D1' => 'Sales', 'E1' => 'Mobil', 'F1' => 'No.Polisi', 'G1' => 'Jam Pinjam', 'H1' => 'Jam Kembali', 'I1' => 'SPV', 'J1' => 'Security', 'K1' => 'Status'];
            foreach ($headers as $cell => $value) {
                $sheet->setCellValue($cell, $value);
                $sheet->getStyle($cell)->getFont()->setBold(true);
                $sheet->getColumnDimension(substr($cell, 0, 1))->setAutoSize(true);
            }

            $row = 2;
            foreach ($checksheets as $i => $cs) {
                $sheet->setCellValue('A' . $row, $i + 1);
                $sheet->setCellValue('B' . $row, \Carbon\Carbon::parse($cs->tanggal_test_drive)->format('d/m/Y'));
                $sheet->setCellValue('C' . $row, $cs->booking->nama_lengkap ?? '-');
                $sheet->setCellValue('D' . $row, $cs->nama_sales);
                $sheet->setCellValue('E' . $row, $cs->tipe_mobil);
                $sheet->setCellValue('F' . $row, $cs->no_polisi);
                $sheet->setCellValue('G' . $row, $cs->jam_pinjam);
                $sheet->setCellValue('H' . $row, $cs->jam_kembali);
                $sheet->setCellValue('I' . $row, $cs->booking->supervisor?->name ?? '-');
                $sheet->setCellValue('J' . $row, $cs->booking->security?->name ?? '-');
                $sheet->setCellValue('K' . $row, $cs->getStatusLabel());
                $row++;
            }

            $filename = 'Checksheet_All_' . date('Ymd_His') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            Log::error('Export all error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export');
        }
    }

    private function getKondisi($checksheet, $item, $stage)
    {
        $baik = $checksheet->{$item . '_' . $stage . '_baik'};
        $tidakBaik = $checksheet->{$item . '_' . $stage . '_tidak_baik'};

        if ($baik) return 'Baik';
        if ($tidakBaik) return 'Tidak Baik';
        return '-';
    }

    private function getBahanBakar($checksheet, $stage)
    {
        $prefix = ($stage === 'pinjam') ? 'bahan_bakar_pinjam_' : 'bahan_bakar_pinjam_kembali_';

        if ($checksheet->{$prefix . '1'}) return '1 Kotak';
        if ($checksheet->{$prefix . '2'}) return '2 Kotak';
        if ($checksheet->{$prefix . '3'}) return '3 Kotak';
        if ($checksheet->{$prefix . '4'}) return 'Di Atas 4 Kotak';
        return '-';
    }

    private function getDokumenStatus($checksheet, $doc, $stage)
    {
        $ada = $checksheet->{$doc . '_' . $stage . '_ada'};
        $tidakAda = $checksheet->{$doc . '_' . $stage . '_tidak_ada'};

        if ($ada) return 'Ada';
        if ($tidakAda) return 'Tidak Ada';
        return '-';
    }

    private function getAllCheckboxFields(): array
    {
        return [
            'body_luar_pinjam_baik',
            'body_luar_pinjam_tidak_baik',
            'ban_velg_pinjam_baik',
            'ban_velg_pinjam_tidak_baik',
            'kaca_spion_pinjam_baik',
            'kaca_spion_pinjam_tidak_baik',
            'interior_pinjam_baik',
            'interior_pinjam_tidak_baik',
            'kebersihan_interior_pinjam_baik',
            'kebersihan_interior_pinjam_tidak_baik',
            'peralatan_pinjam_baik',
            'peralatan_pinjam_tidak_baik',
            'ac_audio_pinjam_baik',
            'ac_audio_pinjam_tidak_baik',
            'lampu_pinjam_baik',
            'lampu_pinjam_tidak_baik',

            'body_luar_kembali_baik',
            'body_luar_kembali_tidak_baik',
            'ban_velg_kembali_baik',
            'ban_velg_kembali_tidak_baik',
            'kaca_spion_kembali_baik',
            'kaca_spion_kembali_tidak_baik',
            'interior_kembali_baik',
            'interior_kembali_tidak_baik',
            'kebersihan_interior_kembali_baik',
            'kebersihan_interior_kembali_tidak_baik',
            'peralatan_kembali_baik',
            'peralatan_kembali_tidak_baik',
            'ac_audio_kembali_baik',
            'ac_audio_kembali_tidak_baik',
            'lampu_kembali_baik',
            'lampu_kembali_tidak_baik',

            'bahan_bakar_pinjam_1',
            'bahan_bakar_pinjam_2',
            'bahan_bakar_pinjam_3',
            'bahan_bakar_pinjam_4',
            'bahan_bakar_pinjam_kembali_1',
            'bahan_bakar_pinjam_kembali_2',
            'bahan_bakar_pinjam_kembali_3',
            'bahan_bakar_pinjam_kembali_4',
            'bahan_bakar_kembali_1',
            'bahan_bakar_kembali_2',
            'bahan_bakar_kembali_3',
            'bahan_bakar_kembali_4',
            'bahan_bakar_kembali_kembali_1',
            'bahan_bakar_kembali_kembali_2',
            'bahan_bakar_kembali_kembali_3',
            'bahan_bakar_kembali_kembali_4',

            'stnk_pinjam_ada',
            'stnk_pinjam_tidak_ada',
            'kunci_utama_pinjam_ada',
            'kunci_utama_pinjam_tidak_ada',
            'remote_keyless_pinjam_ada',
            'remote_keyless_pinjam_tidak_ada',

            'stnk_kembali_ada',
            'stnk_kembali_tidak_ada',
            'kunci_utama_kembali_ada',
            'kunci_utama_kembali_tidak_ada',
            'remote_keyless_kembali_ada',
            'remote_keyless_kembali_tidak_ada',

            'air_mineral_pinjam_ada',
            'air_mineral_pinjam_tidak_ada',
            'air_mineral_kembali_ada',
            'air_mineral_kembali_tidak_ada',
        ];
    }

    private function userHasRole($user, array $roles): bool
    {
        if (!$user) return false;
        if (method_exists($user, 'hasRole')) return $user->hasRole($roles);
        if (isset($user->role)) return in_array($user->role, $roles, true);
        return false;
    }

    private function userCanAccessChecksheet($user): bool
    {
        if (!$user) return false;
        if (method_exists($user, 'canAccessChecksheet')) return $user->canAccessChecksheet();
        return $this->userHasRole($user, ['admin', 'security']);
    }

    public function getChecksheetSummaryByEmail($email)
    {
        try {
            $decodedEmail = urldecode($email);
            Log::info('Getting checksheet summary for email: ' . $decodedEmail);

            $bookings = TestDriveBooking::where('email', $decodedEmail)
                ->with(['checksheet', 'supervisor', 'security'])
                ->orderBy('tanggal_booking', 'desc')
                ->get();

            $summaries = [];

            foreach ($bookings as $booking) {
                if ($booking->checksheet) {
                    $checksheet = $booking->checksheet;

                    $pinjamIssues = [];
                    if ($checksheet->body_luar_pinjam_tidak_baik) $pinjamIssues[] = 'Body Luar';
                    if ($checksheet->ban_velg_pinjam_tidak_baik) $pinjamIssues[] = 'Ban & Velg';
                    if ($checksheet->kaca_spion_pinjam_tidak_baik) $pinjamIssues[] = 'Kaca & Spion';
                    if ($checksheet->interior_pinjam_tidak_baik) $pinjamIssues[] = 'Interior';
                    if ($checksheet->kebersihan_interior_pinjam_tidak_baik) $pinjamIssues[] = 'Kebersihan Interior';
                    if ($checksheet->peralatan_pinjam_tidak_baik) $pinjamIssues[] = 'Peralatan';
                    if ($checksheet->ac_audio_pinjam_tidak_baik) $pinjamIssues[] = 'AC & Audio';
                    if ($checksheet->lampu_pinjam_tidak_baik) $pinjamIssues[] = 'Lampu';

                    $kembaliIssues = [];
                    if ($checksheet->body_luar_kembali_tidak_baik) $kembaliIssues[] = 'Body Luar';
                    if ($checksheet->ban_velg_kembali_tidak_baik) $kembaliIssues[] = 'Ban & Velg';
                    if ($checksheet->kaca_spion_kembali_tidak_baik) $kembaliIssues[] = 'Kaca & Spion';
                    if ($checksheet->interior_kembali_tidak_baik) $kembaliIssues[] = 'Interior';
                    if ($checksheet->kebersihan_interior_kembali_tidak_baik) $kembaliIssues[] = 'Kebersihan Interior';
                    if ($checksheet->peralatan_kembali_tidak_baik) $kembaliIssues[] = 'Peralatan';
                    if ($checksheet->ac_audio_kembali_tidak_baik) $kembaliIssues[] = 'AC & Audio';
                    if ($checksheet->lampu_kembali_tidak_baik) $kembaliIssues[] = 'Lampu';

                    $changedConditions = [];
                    if ($checksheet->body_luar_pinjam_baik && $checksheet->body_luar_kembali_tidak_baik)
                        $changedConditions[] = 'Body Luar';
                    if ($checksheet->ban_velg_pinjam_baik && $checksheet->ban_velg_kembali_tidak_baik)
                        $changedConditions[] = 'Ban & Velg';
                    if ($checksheet->kaca_spion_pinjam_baik && $checksheet->kaca_spion_kembali_tidak_baik)
                        $changedConditions[] = 'Kaca & Spion';
                    if ($checksheet->interior_pinjam_baik && $checksheet->interior_kembali_tidak_baik)
                        $changedConditions[] = 'Interior';
                    if ($checksheet->kebersihan_interior_pinjam_baik && $checksheet->kebersihan_interior_kembali_tidak_baik)
                        $changedConditions[] = 'Kebersihan Interior';
                    if ($checksheet->peralatan_pinjam_baik && $checksheet->peralatan_kembali_tidak_baik)
                        $changedConditions[] = 'Peralatan';
                    if ($checksheet->ac_audio_pinjam_baik && $checksheet->ac_audio_kembali_tidak_baik)
                        $changedConditions[] = 'AC & Audio';
                    if ($checksheet->lampu_pinjam_baik && $checksheet->lampu_kembali_tidak_baik)
                        $changedConditions[] = 'Lampu';

                    $fuelPinjam = $this->getBahanBakar($checksheet, 'pinjam');
                    $fuelKembali = $this->getBahanBakar($checksheet, 'kembali');
                    $fuelChanged = ($fuelPinjam !== $fuelKembali && $fuelPinjam !== '-' && $fuelKembali !== '-');

                    $dokumenIssues = [];

                    if ($checksheet->stnk_pinjam_ada && $checksheet->stnk_kembali_tidak_ada) {
                        $dokumenIssues[] = 'STNK Hilang';
                    } elseif ($checksheet->stnk_pinjam_tidak_ada && $checksheet->stnk_kembali_ada) {
                        $dokumenIssues[] = 'STNK Bertambah';
                    }

                    if ($checksheet->kunci_utama_pinjam_ada && $checksheet->kunci_utama_kembali_tidak_ada) {
                        $dokumenIssues[] = 'Kunci Utama Hilang';
                    } elseif ($checksheet->kunci_utama_pinjam_tidak_ada && $checksheet->kunci_utama_kembali_ada) {
                        $dokumenIssues[] = 'Kunci Utama Bertambah';
                    }

                    if ($checksheet->remote_keyless_pinjam_ada && $checksheet->remote_keyless_kembali_tidak_ada) {
                        $dokumenIssues[] = 'Remote/Keyless Hilang';
                    } elseif ($checksheet->remote_keyless_pinjam_tidak_ada && $checksheet->remote_keyless_kembali_ada) {
                        $dokumenIssues[] = 'Remote/Keyless Bertambah';
                    }

                    $kelengkapanIssues = [];
                    if ($checksheet->air_mineral_pinjam_ada && $checksheet->air_mineral_kembali_tidak_ada) {
                        $kelengkapanIssues[] = 'Air Mineral Hilang';
                    } elseif ($checksheet->air_mineral_pinjam_tidak_ada && $checksheet->air_mineral_kembali_ada) {
                        $kelengkapanIssues[] = 'Air Mineral Bertambah';
                    }

                    $tanggalPewangi = $checksheet->tanggal_penggantian_pewangi
                        ? \Carbon\Carbon::parse($checksheet->tanggal_penggantian_pewangi)->format('d F Y')
                        : null;

                    $hasIssues = !empty($pinjamIssues) || !empty($kembaliIssues) ||
                        !empty($changedConditions) || $fuelChanged ||
                        !empty($dokumenIssues) || !empty($kelengkapanIssues);

                    $summaries[] = [
                        'checksheet_id' => $checksheet->id,
                        'booking_date' => \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y'),
                        'test_drive_date' => \Carbon\Carbon::parse($checksheet->tanggal_test_drive)->format('d F Y'),
                        'car' => $booking->mobil_test_drive,
                        'no_polisi' => $checksheet->no_polisi,
                        'status' => $hasIssues ? 'warning' : 'good',
                        'status_label' => $hasIssues ? 'Ada Masalah' : 'Semua Baik',
                        'jam_pinjam' => $checksheet->jam_pinjam,
                        'jam_kembali' => $checksheet->jam_kembali,
                        'pinjam_issues' => $pinjamIssues,
                        'kembali_issues' => $kembaliIssues,
                        'changed_conditions' => $changedConditions,
                        'fuel_pinjam' => $fuelPinjam,
                        'fuel_kembali' => $fuelKembali,
                        'fuel_changed' => $fuelChanged,
                        'dokumen_issues' => $dokumenIssues,
                        'kelengkapan_issues' => $kelengkapanIssues,
                        'tanggal_penggantian_pewangi' => $tanggalPewangi,
                    ];
                }
            }

            Log::info('Found ' . count($summaries) . ' checksheets for ' . $decodedEmail);

            return response()->json([
                'success' => true,
                'data' => $summaries
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting checksheet summary: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat summary checksheet',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $checksheet = Checksheet::findOrFail($id);

            $currentUser = Auth::user();
            
            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized - User not authenticated'
                ], 401);
            }

            if (!$this->userCanAccessChecksheet($currentUser) && $checksheet->user_id !== $currentUser->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $bookingId = $checksheet->booking_id;
            $customerName = $checksheet->nama_customer;

            $checksheet->delete();

            Log::info('✅ Checksheet deleted:', [
                'checksheet_id' => $id,
                'booking_id' => $bookingId,
                'customer' => $customerName,
                'deleted_by' => $currentUser->email ?? 'unknown'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checksheet berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting checksheet: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}