<?php

namespace App\Http\Controllers;

use App\Models\TestDriveBooking;
use App\Models\PameranBooking;
use App\Models\Checksheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            $testDriveQuery = TestDriveBooking::query();

            if ($user->role === 'branch_manager') {
                $testDriveQuery->whereIn('status', [
                    'Diproses',
                    'Dikonfirmasi',
                    'Sedang test drive',
                    'Selesai',
                    'Perawatan',
                    'Dibatalkan'
                ]);
            } elseif ($user->role === 'security') {
                $testDriveQuery->whereIn('status', [
                    'Dikonfirmasi',
                    'Sedang test drive',
                    'Selesai',
                    'Perawatan'
                ]);
            } elseif ($user->role === 'spv') {
                $testDriveQuery->where('supervisor_user_id', $user->id)
                    ->whereIn('status', [
                        'Menunggu',
                        'Diproses',
                        'Dikonfirmasi',
                        'Sedang test drive',
                        'Selesai',
                        'Perawatan',
                        'Dibatalkan'
                    ]);
            }

            $testDriveBookings = $testDriveQuery->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    $approvalStatus = 'pending';
                    $approvalLabel  = 'Menunggu';

                    if ($booking->status === 'Dikonfirmasi') {
                        $approvalStatus = 'approved';
                        $approvalLabel  = 'Disetujui';
                    } elseif ($booking->status === 'Dibatalkan') {
                        $approvalStatus = 'not_approved';
                        $approvalLabel  = 'Dibatalkan';
                    }

                    return [
                        'id'                  => $booking->id,
                        'booking_type'        => 'test_drive',
                        'customer'            => $booking->nama_lengkap,
                        'phone'               => $booking->nomor_telepon,
                        'email'               => $booking->email,
                        'ktp'                 => $booking->no_ktp,
                        'address'             => $booking->test_drive_location ?? '-',
                        'car'                 => $booking->mobil_test_drive,
                        'date'                => $booking->formatted_date,
                        'rawDate'             => $booking->tanggal_booking,
                        'status'              => $booking->status,
                        'approval_status'     => $approvalStatus,
                        'approval_label'      => $approvalLabel,
                        'is_approved'         => ($approvalStatus === 'approved'),
                        'spv'                 => $booking->supervisor_user_name ?? '-',
                        'security'            => '-',
                        'sales_name'          => $booking->sales_name,
                        'sales_phone'         => $booking->sales_phone,
                        'sales_spv_name'      => $booking->supervisor_user_name ?? '-',
                        'test_drive_time'     => $booking->test_drive_time,
                        'test_drive_location' => $booking->test_drive_location ?? '-',
                    ];
                });

            $pameranQuery = PameranBooking::query();

            if ($user->role === 'branch_manager') {
                $pameranQuery->whereIn('status', [
                    'Diproses',
                    'Dikonfirmasi',
                    'Sedang Pameran',
                    'Selesai',
                    'Perawatan',
                    'Dibatalkan'
                ]);
            } elseif ($user->role === 'security') {
                $pameranQuery->whereIn('status', ['Dikonfirmasi', 'Sedang Pameran', 'Selesai', 'Perawatan']);
            } elseif ($user->role === 'spv') {
                $pameranQuery->where('supervisor_user_id', $user->id)
                    ->whereIn('status', [
                        'Menunggu',
                        'Diproses',
                        'Dikonfirmasi',
                        'Sedang Pameran',
                        'Selesai',
                        'Perawatan',
                        'Dibatalkan'
                    ]);
            }

            $pameranBookings = $pameranQuery->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    return [
                        'id'              => $booking->id,
                        'booking_type'    => 'pameran',
                        'customer'        => $booking->nama_pic,
                        'phone'           => $booking->nomor_telepon ?? '-',
                        'email'           => $booking->email ?? '-',
                        'ktp'             => '0000000000000000',
                        'address'         => $booking->target_prospect,
                        'car'             => $booking->mobil,
                        'date'            => $booking->formatted_date,
                        'rawDate'         => $booking->tanggal_booking,
                        'status'          => $booking->status,
                        'spv'             => $booking->supervisor_name,
                        'security'        => '-',
                        'sales_spv_name'  => $booking->supervisor_name,
                        'sales_name'      => $booking->supervisor_name,
                        'sales_phone'     => '-',
                        'event_date'      => $booking->formatted_event_date,
                        'event_location'  => $booking->lokasi_acara ?? '-',
                        'target_prospect' => $booking->target_prospect,
                        'start_date'      => $booking->formatted_start_date,
                        'end_date'        => $booking->formatted_end_date,
                    ];
                });

            $allBookings = $testDriveBookings->concat($pameranBookings)
                ->sortByDesc('rawDate')
                ->values();

            return response()->json(['success' => true, 'data' => $allBookings]);
        } catch (\Exception $e) {
            Log::error('Error loading bookings: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error loading bookings: ' . $e->getMessage()], 500);
        }
    }

    public function getStaffData()
    {
        try {
            $supervisors = User::where('role', 'spv')->select('id', 'name', 'email')->orderBy('name')->get()
                ->map(fn($spv) => ['id' => $spv->id, 'name' => $spv->name, 'position' => 'SPV', 'phone' => $spv->email]);

            $securities = User::where('role', 'security')->select('id', 'name', 'email')->orderBy('name')->get()
                ->map(fn($sec) => ['id' => $sec->id, 'name' => $sec->name, 'position' => 'Security', 'phone' => $sec->email]);

            return response()->json(['success' => true, 'data' => ['supervisors' => $supervisors, 'securities' => $securities]]);
        } catch (\Exception $e) {
            Log::error('Error loading staff data: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error loading staff data: ' . $e->getMessage()], 500);
        }
    }

    public function getCustomerData()
    {
        try {
            $bookings = TestDriveBooking::orderBy('created_at', 'desc')->get();

            $customerData = [];

            foreach ($bookings as $booking) {
                $name = $booking->nama_lengkap;

                if (!isset($customerData[$name])) {
                    $customerData[$name] = [
                        'name'              => $name,
                        'phone'             => $booking->nomor_telepon,
                        'email'             => $booking->email,
                        'ktp'               => $booking->no_ktp,
                        'address'           => $booking->test_drive_location ?? '-',
                        'assignedSPV'       => $booking->supervisor_user_name ?? '-',
                        'assignedSecurity'  => '-',
                        'totalBookings'     => 0,
                        'lastCar'           => null,
                        'bookingHistory'    => [],
                        'checksheetSummary' => []
                    ];
                }

                $customerData[$name]['totalBookings']++;
                $customerData[$name]['lastCar'] = $booking->mobil_test_drive;
                $customerData[$name]['bookingHistory'][] = [
                    'date'   => $booking->formatted_date,
                    'car'    => $booking->mobil_test_drive,
                    'status' => $booking->status
                ];
            }

            $emails = array_column(array_values($customerData), 'email');

            $allChecksheets = Checksheet::with('booking')
                ->whereHas('booking', fn($q) => $q->whereIn('email', $emails))
                ->get()
                ->groupBy(fn($cs) => $cs->booking->email ?? null);

            foreach ($customerData as $name => &$customer) {
                $customerChecksheets = $allChecksheets->get($customer['email'], collect());
                $summaries = [];

                foreach ($customerChecksheets as $checksheet) {
                    $booking = $checksheet->booking;
                    if (!$booking) continue;

                    $pinjamIssues      = $this->getIssues($checksheet, 'pinjam');
                    $kembaliIssues     = $this->getIssues($checksheet, 'kembali');
                    $changedConditions = $this->getChangedConditions($checksheet);
                    $fuelPinjam        = $this->getBahanBakarLevel($checksheet, 'pinjam');
                    $fuelKembali       = $this->getBahanBakarLevel($checksheet, 'kembali');
                    $fuelChanged       = ($fuelPinjam !== $fuelKembali && $fuelPinjam !== '-' && $fuelKembali !== '-');
                    $dokumenIssues     = $this->getDokumenIssues($checksheet);
                    $kelengkapanIssues = $this->getKelengkapanIssues($checksheet);
                    $hasIssues         = !empty($pinjamIssues) || !empty($kembaliIssues) || !empty($changedConditions)
                        || $fuelChanged || !empty($dokumenIssues) || !empty($kelengkapanIssues);

                    $summaries[] = [
                        'checksheet_id'               => $checksheet->id,
                        'booking_date'                => Carbon::parse($booking->tanggal_booking)->format('d F Y'),
                        'test_drive_date'             => Carbon::parse($checksheet->tanggal_test_drive)->format('d F Y'),
                        'car'                         => $booking->mobil_test_drive,
                        'no_polisi'                   => $checksheet->no_polisi,
                        'status'                      => $hasIssues ? 'warning' : 'good',
                        'status_label'                => $hasIssues ? 'Ada Masalah' : 'Semua Baik',
                        'jam_pinjam'                  => $checksheet->jam_pinjam,
                        'jam_kembali'                 => $checksheet->jam_kembali,
                        'pinjam_issues'               => $pinjamIssues,
                        'kembali_issues'              => $kembaliIssues,
                        'changed_conditions'          => $changedConditions,
                        'fuel_pinjam'                 => $fuelPinjam,
                        'fuel_kembali'                => $fuelKembali,
                        'fuel_changed'                => $fuelChanged,
                        'dokumen_issues'              => $dokumenIssues,
                        'kelengkapan_issues'          => $kelengkapanIssues,
                        'tanggal_penggantian_pewangi' => $checksheet->tanggal_penggantian_pewangi
                            ? Carbon::parse($checksheet->tanggal_penggantian_pewangi)->format('d F Y')
                            : null,
                    ];
                }

                $customer['checksheetSummary'] = $summaries;
            }

            return response()->json(['success' => true, 'data' => array_values($customerData)]);
        } catch (\Exception $e) {
            Log::error('Error loading customer data: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error loading customer data: ' . $e->getMessage()], 500);
        }
    }

    private function getIssues($checksheet, string $stage): array
    {
        $fields = ['body_luar', 'ban_velg', 'kaca_spion', 'interior', 'kebersihan_interior', 'peralatan', 'ac_audio', 'lampu'];
        $labels = ['Body Luar', 'Ban & Velg', 'Kaca & Spion', 'Interior', 'Kebersihan Interior', 'Peralatan', 'AC & Audio', 'Lampu'];
        $issues = [];
        foreach ($fields as $i => $field) {
            if ($checksheet->{"{$field}_{$stage}_tidak_baik"}) $issues[] = $labels[$i];
        }
        return $issues;
    }

    private function getChangedConditions($checksheet): array
    {
        $fields = ['body_luar', 'ban_velg', 'kaca_spion', 'interior', 'kebersihan_interior', 'peralatan', 'ac_audio', 'lampu'];
        $labels = ['Body Luar', 'Ban & Velg', 'Kaca & Spion', 'Interior', 'Kebersihan Interior', 'Peralatan', 'AC & Audio', 'Lampu'];
        $changed = [];
        foreach ($fields as $i => $field) {
            if ($checksheet->{"{$field}_pinjam_baik"} && $checksheet->{"{$field}_kembali_tidak_baik"}) $changed[] = $labels[$i];
        }
        return $changed;
    }

    private function getBahanBakarLevel($checksheet, string $stage): string
    {
        $prefix = $stage === 'pinjam' ? 'bahan_bakar_pinjam_' : 'bahan_bakar_kembali_';
        for ($i = 1; $i <= 4; $i++) {
            if ($checksheet->{$prefix . $i}) return $i < 4 ? "{$i} Kotak" : 'Di Atas 4 Kotak';
        }
        return '-';
    }

    private function getDokumenIssues($checksheet): array
    {
        $issues = [];
        foreach (['stnk' => 'STNK', 'kunci_utama' => 'Kunci Utama', 'remote_keyless' => 'Remote/Keyless'] as $key => $label) {
            if ($checksheet->{"{$key}_pinjam_ada"} && $checksheet->{"{$key}_kembali_tidak_ada"}) $issues[] = "{$label} Hilang";
            elseif ($checksheet->{"{$key}_pinjam_tidak_ada"} && $checksheet->{"{$key}_kembali_ada"}) $issues[] = "{$label} Bertambah";
        }
        return $issues;
    }

    private function getKelengkapanIssues($checksheet): array
    {
        $issues = [];
        if ($checksheet->air_mineral_pinjam_ada && $checksheet->air_mineral_kembali_tidak_ada) $issues[] = 'Air Mineral Hilang';
        elseif ($checksheet->air_mineral_pinjam_tidak_ada && $checksheet->air_mineral_kembali_ada) $issues[] = 'Air Mineral Bertambah';
        return $issues;
    }

    public function storeManual(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_type'        => 'required|in:test_drive,pameran',
                'nama_lengkap'        => 'required|string|max:100',
                'nomor_telepon'       => 'required|string|max:15',
                'email'               => 'required|email|max:100',
                'no_ktp'              => 'required|string|size:16',
                'mobil_test_drive'    => 'required|string|max:100',
                'tanggal_booking'     => 'required|date',
                'supervisor_user_id'  => 'required|exists:users,id',
                'sales_name'          => 'nullable|string|max:100',
                'sales_phone'         => 'nullable|string|max:15',
                'test_drive_time'     => 'nullable',
                'test_drive_location' => 'nullable|string|max:255',
            ]);

            $supervisor = User::find($validated['supervisor_user_id']);
            $validated['supervisor_user_name'] = $supervisor?->name;
            $validated['status'] = 'Menunggu';

            $booking = TestDriveBooking::create($validated);

            return response()->json(['success' => true, 'message' => 'Booking berhasil ditambahkan!', 'data' => $booking]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error storing manual booking: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'message' => '🔒 Anda harus login terlebih dahulu!'], 401);
            }

            $user = Auth::user();
            if (!in_array($user->role, ['sales', 'admin'])) {
                return response()->json(['success' => false, 'message' => '⚠️ Akses Ditolak! Hanya akun Sales yang dapat melakukan booking.'], 403);
            }

            $bookingType = $request->input('booking_type', 'test_drive');
            if ($bookingType === 'pameran') return $this->storePameranBooking($request);

            $validated = $request->validate([
                'car'                 => 'required|string|max:100',
                'sales_user_id'       => 'required|exists:users,id',
                'sales_name'          => 'required|string|max:100',
                'sales_phone'         => 'required|string|max:15',
                'customer_name'       => 'required|string|max:100',
                'phone'               => 'required|string|max:15',
                'email'               => 'required|email|max:100',
                'ktp'                 => 'required|string|size:16',
                'test_drive_time'     => 'required',
                'test_drive_location' => 'required|string|max:255'
            ]);

            $selectedSPV = User::findOrFail($validated['sales_user_id']);
            if ($selectedSPV->role !== 'spv') {
                return response()->json(['success' => false, 'message' => 'User yang dipilih bukan SPV!'], 400);
            }

            $booking = TestDriveBooking::create([
                'nama_lengkap'         => $validated['customer_name'],
                'nomor_telepon'        => $validated['phone'],
                'email'                => $validated['email'],
                'no_ktp'               => $validated['ktp'],
                'mobil_test_drive'     => $validated['car'],
                'tanggal_booking'      => now()->toDateString(),
                'status'               => 'Menunggu',
                'supervisor_user_id'   => $selectedSPV->id,
                'supervisor_user_name' => $selectedSPV->name,
                'sales_name'           => $validated['sales_name'],
                'sales_phone'          => $validated['sales_phone'],
                'test_drive_time'      => $validated['test_drive_time'],
                'test_drive_location'  => $validated['test_drive_location'],
                'booking_type'         => 'test_drive'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat dan dikirimkan ke Supervisor ' . $selectedSPV->name . '!',
                'data'    => ['booking_id' => $booking->id, 'car' => $booking->mobil_test_drive, 'status' => $booking->status, 'assigned_spv' => $selectedSPV->name]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('❌ Booking error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan.', 'error' => config('app.debug') ? $e->getMessage() : null], 500);
        }
    }

    private function storePameranBooking(Request $request)
    {
        try {
            $validated = $request->validate([
                'car'             => 'required|string|max:100',
                'sales_user_id'   => 'required|exists:users,id',
                'pic_name'        => 'required|string|max:100',
                'pic_phone'       => 'required|string|max:15',
                'pic_email'       => 'required|email|max:100',
                'target_prospect' => 'required|string',
                'event_date'      => 'required|date',
                'event_location'  => 'required|string|max:255',
                'start_date'      => 'required|date',
                'end_date'        => 'required|date|after_or_equal:start_date'
            ]);

            $selectedSPV = User::findOrFail($validated['sales_user_id']);
            if ($selectedSPV->role !== 'spv') {
                return response()->json(['success' => false, 'message' => 'User yang dipilih bukan SPV!'], 400);
            }

            $booking = PameranBooking::create([
                'nama_pic'             => $validated['pic_name'],
                'nomor_telepon'        => $validated['pic_phone'],
                'email'                => $validated['pic_email'],
                'mobil'                => $validated['car'],
                'target_prospect'      => $validated['target_prospect'],
                'tanggal_booking'      => now()->toDateString(),
                'tanggal_acara'        => $validated['event_date'],
                'lokasi_acara'         => $validated['event_location'],
                'tanggal_mulai'        => $validated['start_date'],
                'tanggal_selesai'      => $validated['end_date'],
                'status'               => 'Menunggu',
                'supervisor_user_id'   => $selectedSPV->id,
                'supervisor_user_name' => $selectedSPV->name,
                'booking_type'         => 'pameran'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking Pameran/Movex berhasil! Menunggu approval SPV.',
                'data'    => ['booking_id' => $booking->id, 'car' => $booking->mobil, 'status' => $booking->status, 'assigned_spv' => $selectedSPV->name, 'event_date' => $booking->formatted_event_date, 'duration' => $booking->formatted_start_date . ' - ' . $booking->formatted_end_date]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('❌ Pameran booking error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan.', 'error' => config('app.debug') ? $e->getMessage() : null], 500);
        }
    }

    public function getSPVList(Request $request)
    {
        try {
            $spvList = User::where('role', 'spv')->select('id', 'name', 'email')->orderBy('name', 'asc')->get()
                ->map(fn($spv) => ['id' => $spv->id, 'name' => $spv->name, 'email' => $spv->email]);
            return response()->json(['success' => true, 'data' => $spvList]);
        } catch (\Exception $e) {
            Log::error('❌ Error loading SPV list: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal memuat daftar SPV'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $user      = Auth::user();
            $validated = $request->validate([
                'status'       => ['required', 'in:Menunggu,Diproses,Dikonfirmasi,Sedang test drive,Sedang Pameran,Selesai,Perawatan,Dibatalkan'],
                'booking_type' => 'required|in:test_drive,pameran'
            ]);

            if ($validated['booking_type'] === 'test_drive') {
                $booking = TestDriveBooking::find($id);
                $bookingTypeName = 'Test Drive';
            } else {
                $booking = PameranBooking::find($id);
                $bookingTypeName = 'Pameran/Movex';
            }

            if (!$booking) return response()->json(['success' => false, 'message' => "Booking {$bookingTypeName} ID {$id} tidak ditemukan"], 404);

            if ($validated['booking_type'] === 'pameran' && $validated['status'] === 'Sedang test drive')
                return response()->json(['success' => false, 'message' => 'Status tidak valid untuk Pameran.'], 400);
            if ($validated['booking_type'] === 'test_drive' && $validated['status'] === 'Sedang Pameran')
                return response()->json(['success' => false, 'message' => 'Status tidak valid untuk Test Drive.'], 400);

            if ($user->role === 'branch_manager') {
                if (!in_array($validated['status'], ['Dikonfirmasi', 'Dibatalkan']))
                    return response()->json(['success' => false, 'message' => 'Branch Manager hanya dapat Dikonfirmasi atau Dibatalkan.'], 403);
                if ($validated['status'] === 'Dikonfirmasi' && $booking->status !== 'Diproses')
                    return response()->json(['success' => false, 'message' => "Hanya bisa approve booking berstatus 'Diproses'."], 403);
                if ($validated['status'] === 'Dibatalkan' && !in_array($booking->status, ['Diproses', 'Dikonfirmasi']))
                    return response()->json(['success' => false, 'message' => "Hanya bisa cancel booking berstatus 'Diproses' atau 'Dikonfirmasi'."], 403);
                $booking->update(['status' => $validated['status']]);
                return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!', 'data' => $booking]);
            }

            if ($user->role === 'spv') {
                if ($booking->status !== 'Menunggu')
                    return response()->json(['success' => false, 'message' => "SPV hanya dapat action booking berstatus 'Menunggu'."], 403);
                if (!in_array($validated['status'], ['Diproses', 'Dibatalkan']))
                    return response()->json(['success' => false, 'message' => 'SPV hanya dapat ke "Diproses" atau "Dibatalkan".'], 403);
                $booking->update(['status' => $validated['status']]);
                return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!', 'data' => $booking]);
            }

            if ($user->role === 'security') {
                $validInProgress = ($validated['booking_type'] === 'pameran') ? 'Sedang Pameran' : 'Sedang test drive';
                $allowedStatuses = [$validInProgress, 'Selesai', 'Perawatan'];
                if (!in_array($validated['status'], $allowedStatuses))
                    return response()->json(['success' => false, 'message' => 'Security hanya dapat ke: ' . implode(', ', $allowedStatuses)], 403);
                if (!in_array($booking->status, ['Dikonfirmasi', $validInProgress, 'Selesai', 'Perawatan']))
                    return response()->json(['success' => false, 'message' => 'Booking belum dikonfirmasi.'], 403);
                $booking->update(['status' => $validated['status']]);
                if ($validated['booking_type'] === 'test_drive') {
                    $checksheet = Checksheet::where('booking_id', $booking->id)->first();
                    if ($checksheet && in_array($validated['status'], ['Sedang test drive', 'Selesai', 'Perawatan'])) {
                        $checksheet->update(['status_mobil' => $validated['status']]);
                    }
                }
                return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!', 'data' => $booking]);
            }

            if ($user->role === 'admin') {
                $booking->update(['status' => $validated['status']]);
                if ($validated['booking_type'] === 'test_drive') {
                    $checksheet = Checksheet::where('booking_id', $booking->id)->first();
                    if ($checksheet && in_array($validated['status'], ['Sedang test drive', 'Selesai', 'Perawatan'])) {
                        $checksheet->update(['status_mobil' => $validated['status']]);
                    }
                }
                return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!', 'data' => $booking]);
            }

            return response()->json(['success' => false, 'message' => 'Tidak memiliki izin mengubah status.'], 403);
        } catch (\Exception $e) {
            Log::error('❌ Error updating status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateCustomer(Request $request)
    {
        try {
            $validated = $request->validate([
                'original_email'      => 'required|email',
                'nama_lengkap'        => 'required|string|max:100',
                'nomor_telepon'       => 'required|string|max:15',
                'email'               => 'required|email|max:100',
                'no_ktp'              => 'required|string|size:16',
                'test_drive_location' => 'nullable|string|max:255',
                'supervisor_user_id'  => 'nullable|exists:users,id',
            ]);

            $updateData = [
                'nama_lengkap'  => $validated['nama_lengkap'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'email'         => $validated['email'],
                'no_ktp'        => $validated['no_ktp'],
            ];

            if (!empty($validated['test_drive_location'])) {
                $updateData['test_drive_location'] = $validated['test_drive_location'];
            }

            if (!empty($validated['supervisor_user_id'])) {
                $supervisor = User::find($validated['supervisor_user_id']);
                $updateData['supervisor_user_id']   = $validated['supervisor_user_id'];
                $updateData['supervisor_user_name'] = $supervisor?->name;
            }

            $updated = TestDriveBooking::where('email', $validated['original_email'])->update($updateData);
            return response()->json(['success' => true, 'message' => 'Data customer berhasil diupdate!', 'updated_count' => $updated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating customer: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function deleteCustomer(Request $request)
    {
        try {
            $validated = $request->validate(['email' => 'required|email']);
            $deleted = TestDriveBooking::where('email', $validated['email'])->delete();
            return response()->json(['success' => true, 'message' => 'Customer dan semua bookingnya berhasil dihapus!', 'deleted_count' => $deleted]);
        } catch (\Exception $e) {
            Log::error('Error deleting customer: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function getNotifications()
    {
        try {
            if (!Auth::check()) return response()->json(['success' => true, 'data' => []]);
            $bookings = TestDriveBooking::where('email', Auth::user()->email)
                ->where('updated_at', '>=', now()->subDays(7))
                ->whereIn('status', ['Dikonfirmasi', 'Dibatalkan'])
                ->orderBy('updated_at', 'desc')->get()
                ->map(fn($b) => ['id' => $b->id, 'message' => "Booking {$b->mobil_test_drive} - Status: {$b->status}", 'type' => $b->status === 'Dikonfirmasi' ? 'approved' : 'rejected', 'created_at' => $b->updated_at->format('Y-m-d H:i:s')]);
            return response()->json(['success' => true, 'data' => $bookings]);
        } catch (\Exception $e) {
            Log::error('Error getting notifications: ' . $e->getMessage());
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    public function getNewNotifications()
    {
        try {
            if (!Auth::check()) return response()->json(['success' => true, 'data' => []]);
            $notifications = TestDriveBooking::where('email', Auth::user()->email)
                ->where('updated_at', '>=', now()->subMinutes(5))
                ->whereIn('status', ['Dikonfirmasi', 'Dibatalkan'])
                ->orderBy('updated_at', 'desc')->get()
                ->map(fn($b) => ['id' => $b->id, 'message' => "Booking {$b->mobil_test_drive} - Status: {$b->status}", 'type' => $b->status === 'Dikonfirmasi' ? 'approved' : 'rejected']);
            return response()->json(['success' => true, 'data' => $notifications]);
        } catch (\Exception $e) {
            Log::error('Error getting new notifications: ' . $e->getMessage());
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    public function markNotificationRead($id)
    {
        try {
            TestDriveBooking::findOrFail($id);
            return response()->json(['success' => true, 'message' => 'Notification marked as read']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error marking notification'], 500);
        }
    }

    public function getVehicleStatus()
    {
        try {
            $vehicles = [
                'Toyota Hilux Rangga',
                'Toyota Raize Abu Abu',
                'Toyota Zenix',
                'Toyota Agya Putih',
                'Toyota Fortuner',
                'Toyota Agya GR Merah',
            ];

            $testDriveBookings = TestDriveBooking::whereIn('mobil_test_drive', $vehicles)
                ->whereIn('status', ['Menunggu', 'Diproses', 'Dikonfirmasi', 'Sedang test drive', 'Perawatan'])
                ->orderBy('created_at', 'desc')->get()
                ->groupBy('mobil_test_drive')->map(fn($g) => $g->first());

            $pameranBookings = PameranBooking::whereIn('mobil', $vehicles)
                ->whereIn('status', ['Menunggu', 'Diproses', 'Dikonfirmasi', 'Sedang Pameran', 'Perawatan'])
                ->orderBy('created_at', 'desc')->get()
                ->groupBy('mobil')->map(fn($g) => $g->first());

            $vehicleStatus = [];
            foreach ($vehicles as $vehicle) {
                $testDriveBooking = $testDriveBookings->get($vehicle);
                $pameranBooking   = $pameranBookings->get($vehicle);
                $activeBooking    = $pameranBooking ?? $testDriveBooking ?? null;
                $bookingType      = $pameranBooking ? 'pameran' : ($testDriveBooking ? 'test_drive' : null);

                if ($activeBooking) {
                    switch ($activeBooking->status) {
                        case 'Menunggu':
                        case 'Diproses':
                        case 'Dikonfirmasi':
                            $vehicleStatus[$vehicle] = ['available' => false, 'status' => $bookingType === 'pameran' ? 'Dibooking untuk Pameran/Movex' : 'Dibooking untuk Test Drive', 'status_code' => 'booked', 'booking_type' => $bookingType, 'booking_id' => $activeBooking->id, 'booking_status' => $activeBooking->status];
                            break;
                        case 'Sedang test drive':
                        case 'Sedang Pameran':
                            $vehicleStatus[$vehicle] = ['available' => false, 'status' => 'Mobil Tidak Tersedia', 'status_code' => 'in_use', 'booking_type' => $bookingType, 'booking_id' => $activeBooking->id, 'booking_status' => $activeBooking->status];
                            break;
                        case 'Perawatan':
                            $vehicleStatus[$vehicle] = ['available' => false, 'status' => 'Mobil Belum Tersedia', 'status_code' => 'maintenance', 'booking_type' => $bookingType, 'booking_id' => $activeBooking->id, 'booking_status' => $activeBooking->status];
                            break;
                        default:
                            $vehicleStatus[$vehicle] = ['available' => true, 'status' => 'Tersedia', 'status_code' => 'available'];
                    }
                } else {
                    $vehicleStatus[$vehicle] = ['available' => true, 'status' => 'Tersedia', 'status_code' => 'available'];
                }
            }

            return response()->json(['success' => true, 'data' => $vehicleStatus]);
        } catch (\Exception $e) {
            Log::error('❌ Error loading vehicle status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal memuat status kendaraan'], 500);
        }
    }

    public function updatePameranBooking(Request $request, $id)
    {
        try {
            $booking   = PameranBooking::findOrFail($id);
            $validated = $request->validate([
                'nama_pic'           => 'sometimes|string|max:100',
                'nomor_telepon'      => 'sometimes|string|max:15',
                'email'              => 'sometimes|email|max:100',
                'mobil'              => 'sometimes|string|max:100',
                'target_prospect'    => 'sometimes|string',
                'tanggal_acara'      => 'sometimes|date',
                'lokasi_acara'       => 'sometimes|string|max:255',
                'tanggal_mulai'      => 'sometimes|date',
                'tanggal_selesai'    => 'sometimes|date|after_or_equal:tanggal_mulai',
                'supervisor_user_id' => 'sometimes|exists:users,id',
                'status'             => 'sometimes|in:Menunggu,Diproses,Dikonfirmasi,Sedang Pameran,Selesai,Perawatan,Dibatalkan'
            ]);

            if (!empty($validated['supervisor_user_id'])) {
                $supervisor = User::find($validated['supervisor_user_id']);
                $validated['supervisor_user_name'] = $supervisor?->name;
            }

            $booking->update($validated);
            return response()->json(['success' => true, 'message' => 'Booking Pameran berhasil diupdate!', 'data' => $booking]);
        } catch (\Exception $e) {
            Log::error('Error updating pameran booking: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
