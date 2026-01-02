<?php

namespace App\Http\Controllers;

use App\Models\TestDriveBooking;
use App\Models\PameranBooking;
use App\Models\Supervisor;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    // Get All Bookings, Branch Manager filter untuk approval workflow
    public function index()
    {
        try {
            $user = Auth::user();

            // TEST DRIVE BOOKINGS
            $testDriveQuery = TestDriveBooking::with(['supervisor', 'security', 'salesUser']);

            // âœ… FIXED: Filter based on user role
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
                // Security: Only see confirmed bookings
                $testDriveQuery->whereIn('status', [
                    'Dikonfirmasi',
                    'Sedang test drive',
                    'Selesai',
                    'Perawatan'
                ]);
            } elseif ($user->role === 'spv') {
                // âœ… CRITICAL FIX: SPV should see bookings where they are assigned as supervisor
                // NOT where they are the sales user!

                // Step 1: Find supervisor record by SPV's name
                $supervisor = Supervisor::where('nama_lengkap', $user->name)->first();

                if ($supervisor) {
                    // Step 2: Filter bookings by supervisor_id
                    $testDriveQuery->where('supervisor_id', $supervisor->id)
                        ->whereIn('status', [
                            'Menunggu',
                            'Diproses',
                            'Dikonfirmasi',
                            'Sedang test drive',
                            'Selesai',
                            'Perawatan',
                            'Dibatalkan'
                        ]);

                    Log::info('SPV Filter Applied:', [
                        'spv_user_id' => $user->id,
                        'spv_name' => $user->name,
                        'supervisor_id' => $supervisor->id
                    ]);
                } else {
                    // Jika SPV tidak ada di tabel supervisors, return empty
                    Log::warning('âš ï¸ SPV not found in supervisors table:', [
                        'spv_user_id' => $user->id,
                        'spv_name' => $user->name
                    ]);

                    // Return empty collection
                    $testDriveQuery->whereRaw('1 = 0'); // Always false condition
                }
            }

            $testDriveBookings = $testDriveQuery->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    // Approval status mapping
                    $approvalStatus = 'pending';
                    $approvalLabel = 'Menunggu';

                    if ($booking->status === 'Dikonfirmasi') {
                        $approvalStatus = 'approved';
                        $approvalLabel = 'Disetujui';
                    } elseif ($booking->status === 'Dibatalkan') {
                        $approvalStatus = 'not_approved';
                        $approvalLabel = 'Dibatalkan';
                    }

                    return [
                        'id' => $booking->id,
                        'booking_type' => 'test_drive',
                        'customer' => $booking->nama_lengkap,
                        'phone' => $booking->nomor_telepon,
                        'email' => $booking->email,
                        'ktp' => $booking->no_ktp,
                        'address' => $booking->alamat,
                        'car' => $booking->mobil_test_drive,
                        'date' => $booking->formatted_date,
                        'rawDate' => $booking->tanggal_booking,
                        'status' => $booking->status,
                        'approval_status' => $approvalStatus,
                        'approval_label' => $approvalLabel,
                        'is_approved' => ($approvalStatus === 'approved'),
                        'spv' => $booking->supervisor->nama_lengkap ?? '-',
                        'security' => $booking->security->nama_lengkap ?? '-',
                        'sales_name' => $booking->sales_name,
                        'sales_phone' => $booking->sales_phone,
                        'sales_spv_name' => $booking->salesUser->name ?? '-',
                        'test_drive_time' => $booking->test_drive_time,
                        'test_drive_location' => $booking->test_drive_location,
                    ];
                });

            // PAMERAN BOOKINGS
            $pameranQuery = PameranBooking::with(['supervisor', 'security']);

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
                // âœ… FIXED: Same fix for Pameran bookings
                $supervisor = Supervisor::where('nama_lengkap', $user->name)->first();

                if ($supervisor) {
                    $pameranQuery->where('supervisor_id', $supervisor->id)
                        ->whereIn('status', [
                            'Menunggu',
                            'Diproses',
                            'Dikonfirmasi',
                            'Sedang Pameran',
                            'Selesai',
                            'Perawatan',
                            'Dibatalkan'
                        ]);
                } else {
                    $pameranQuery->whereRaw('1 = 0'); // Empty result
                }
            }

            $pameranBookings = $pameranQuery->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'booking_type' => 'pameran',
                        'customer' => $booking->nama_pic,
                        'phone' => $booking->nomor_telepon ?? '-',
                        'email' => $booking->email ?? '-',
                        'ktp' => '0000000000000000',
                        'address' => $booking->target_prospect,
                        'car' => $booking->mobil,
                        'date' => $booking->formatted_date,
                        'rawDate' => $booking->tanggal_booking,
                        'status' => $booking->status,
                        'spv' => $booking->supervisor->nama_lengkap ?? '-',
                        'security' => $booking->security->nama_lengkap ?? '-',
                        'sales_spv_name' => $booking->salesUser->name ?? '-',
                        'sales_name' => $booking->salesUser->name ?? '-',
                        'sales_phone' => $booking->salesUser->email ?? '-',
                        'event_date' => $booking->formatted_event_date,
                        'event_location' => $booking->lokasi_acara ?? '-',
                        'target_prospect' => $booking->target_prospect,
                        'start_date' => $booking->formatted_start_date,
                        'end_date' => $booking->formatted_end_date,
                    ];
                });

            // Merge & Sort
            $allBookings = $testDriveBookings->concat($pameranBookings)
                ->sortByDesc('rawDate')
                ->values();

            Log::info('âœ… Bookings loaded successfully:', [
                'user_role' => $user->role,
                'test_drive_count' => $testDriveBookings->count(),
                'pameran_count' => $pameranBookings->count(),
                'total_count' => $allBookings->count()
            ]);

            return response()->json([
                'success' => true,
                'data' => $allBookings
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading bookings: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error loading bookings: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get Staff Data (SPV & Security)
    public function getStaffData()
    {
        try {
            // Ambil SEMUA supervisor dan security
            $supervisors = Supervisor::select('id', 'nama_lengkap', 'position', 'nomor_hp')
                ->orderBy('nama_lengkap')
                ->get()
                ->map(function ($spv) {
                    return [
                        'id' => $spv->id,
                        'name' => $spv->nama_lengkap,
                        'position' => $spv->position,
                        'phone' => $spv->nomor_hp
                    ];
                });

            $securities = Security::select('id', 'nama_lengkap', 'position', 'nomor_hp')
                ->orderBy('nama_lengkap')
                ->get()
                ->map(function ($sec) {
                    return [
                        'id' => $sec->id,
                        'name' => $sec->nama_lengkap,
                        'position' => $sec->position,
                        'phone' => $sec->nomor_hp
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'supervisors' => $supervisors,
                    'securities' => $securities
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading staff data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading staff data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get Customer Data
    public function getCustomerData()
    {
        try {
            $bookings = TestDriveBooking::with(['supervisor', 'security'])
                ->orderBy('created_at', 'desc')
                ->get();

            $customerData = [];

            foreach ($bookings as $booking) {
                $name = $booking->nama_lengkap;

                if (!isset($customerData[$name])) {
                    $customerData[$name] = [
                        'name' => $name,
                        'phone' => $booking->nomor_telepon,
                        'email' => $booking->email,
                        'ktp' => $booking->no_ktp,
                        'address' => $booking->alamat,
                        'assignedSPV' => $booking->supervisor->nama_lengkap ?? '-',
                        'assignedSecurity' => $booking->security->nama_lengkap ?? '-',
                        'totalBookings' => 0,
                        'lastCar' => null,
                        'bookingHistory' => [],
                        'checksheetSummary' => []
                    ];
                }

                $customerData[$name]['totalBookings']++;
                $customerData[$name]['lastCar'] = $booking->mobil_test_drive;
                $customerData[$name]['bookingHistory'][] = [
                    'date' => $booking->formatted_date,
                    'car' => $booking->mobil_test_drive,
                    'status' => $booking->status
                ];
            }

            // Load checksheet summary untuk setiap customer
            foreach ($customerData as $name => &$customer) {
                try {
                    $summaryResponse = app(CheckSheetController::class)
                        ->getChecksheetSummaryByEmail($customer['email']);

                    $summaryData = json_decode($summaryResponse->content(), true);

                    if ($summaryData['success'] ?? false) {
                        $customer['checksheetSummary'] = $summaryData['data'] ?? [];

                        // DEBUG LOG
                        Log::info("âœ… Loaded checksheet for {$name}:", [
                            'email' => $customer['email'],
                            'count' => count($customer['checksheetSummary']),
                            'summaries' => $customer['checksheetSummary']
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error("âŒ Failed to load checksheet for {$name}: " . $e->getMessage());
                    $customer['checksheetSummary'] = [];
                }
            }

            return response()->json([
                'success' => true,
                'data' => array_values($customerData)
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading customer data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading customer data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Store Manual Booking (SPV/Admin Only)

    public function storeManual(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_type' => 'required|in:test_drive,pameran',
                'nama_lengkap' => 'required|string|max:100',
                'nomor_telepon' => 'required|string|max:15',
                'email' => 'required|email|max:100',
                'no_ktp' => 'required|string|size:16',
                'alamat' => 'required|string',
                'mobil_test_drive' => 'required|string|max:100',
                'tanggal_booking' => 'required|date',
                'supervisor_id' => 'required|exists:supervisors,id',
                'security_id' => 'required|exists:securities,id',
                'sales_name' => 'nullable|string|max:100',
                'sales_phone' => 'nullable|string|max:15',
                'test_drive_time' => 'nullable',
                'test_drive_location' => 'nullable|string|max:255',
                'event_date' => 'nullable|date',
                'event_location' => 'nullable|string|max:255',
            ]);

            // SPV manual booking starts as "Menunggu" (pending admin approval)
            $validated['status'] = 'Menunggu';

            $booking = TestDriveBooking::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil ditambahkan! Menunggu approval admin.',
                'data' => $booking
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error storing manual booking: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Store Booking from Welcome Page (Sales)

    public function store(Request $request)
    {
        try {
            // âœ… CRITICAL: Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('âŒ Unauthenticated booking attempt from IP: ' . $request->ip());
                return response()->json([
                    'success' => false,
                    'message' => 'ðŸ”’ Anda harus login terlebih dahulu!\n\n' .
                        'Silakan login dengan akun Sales untuk melakukan booking.\n\n' .
                        'ðŸ“§ Email: sales@toyota.com\n' .
                        'ðŸ”‘ Password: sales123'
                ], 401);
            }

            // âœ… Check if user is Sales or Admin
            $user = Auth::user();
            if (!in_array($user->role, ['sales', 'admin'])) {
                Log::warning('âŒ Unauthorized booking attempt', [
                    'user_email' => $user->email,
                    'user_role' => $user->role,
                    'ip' => $request->ip()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'âš ï¸ Akses Ditolak!\n\n' .
                        'Hanya akun Sales yang dapat melakukan booking dari halaman ini.\n\n' .
                        'ðŸ‘¤ Role Anda saat ini: ' . strtoupper($user->role) . '\n' .
                        'âœ… Role yang dibutuhkan: SALES atau ADMIN\n\n' .
                        'Silakan hubungi administrator jika Anda memerlukan akses.'
                ], 403);
            }

            Log::info('ðŸš€ Booking request received:', $request->all());

            // Check booking type
            $bookingType = $request->input('booking_type', 'test_drive');

            if ($bookingType === 'pameran') {
                return $this->storePameranBooking($request);
            }

            // Test Drive validation
            $validated = $request->validate([
                'car' => 'required|string|max:100',
                'sales_user_id' => 'required|exists:users,id', // âœ… Validasi SPV ID
                'sales_name' => 'required|string|max:100',
                'sales_phone' => 'required|string|max:15',
                'customer_name' => 'required|string|max:100',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:100',
                'ktp' => 'required|string|size:16',
                'test_drive_time' => 'required',
                'test_drive_location' => 'required|string|max:255'
            ]);

            // âœ… NEW: Get SPV yang dipilih sales
            $selectedSPV = \App\Models\User::findOrFail($validated['sales_user_id']);

            if ($selectedSPV->role !== 'spv') {
                return response()->json([
                    'success' => false,
                    'message' => 'User yang dipilih bukan SPV!'
                ], 400);
            }

            Log::info('âœ… Validation passed');

            // âœ… IMPORTANT: Cari supervisor berdasarkan nama SPV yang dipilih
            $supervisor = Supervisor::where('nama_lengkap', $selectedSPV->name)->first();

            if (!$supervisor) {
                Log::error('âŒ Supervisor not found for SPV: ' . $selectedSPV->name);
                return response()->json([
                    'success' => false,
                    'message' => 'Supervisor tidak ditemukan untuk SPV yang dipilih'
                ], 400);
            }

            Log::info('âœ… Supervisor assigned:', [
                'supervisor' => $supervisor->nama_lengkap,
                'spv_user' => $selectedSPV->name
            ]);

            // âœ… REMOVED: Security assignment - tidak perlu lagi

            $booking = TestDriveBooking::create([
                'nama_lengkap' => $validated['customer_name'],
                'nomor_telepon' => $validated['phone'],
                'email' => $validated['email'],
                'no_ktp' => $validated['ktp'],
                'alamat' => $validated['test_drive_location'],
                'mobil_test_drive' => $validated['car'],
                'tanggal_booking' => now()->toDateString(),
                'status' => 'Menunggu',
                'supervisor_id' => $supervisor->id,
                'security_id' => null, // âœ… REMOVED: Security tidak perlu di-assign
                'sales_user_id' => $validated['sales_user_id'], // âœ… SPV ID
                'sales_name' => $validated['sales_name'],
                'sales_phone' => $validated['sales_phone'],
                'test_drive_time' => $validated['test_drive_time'],
                'test_drive_location' => $validated['test_drive_location'],
                'booking_type' => 'test_drive'
            ]);

            Log::info('âœ… Booking created:', ['id' => $booking->id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat dan dikirimkan ke Supervisor ' . $selectedSPV->name . '!', // âœ… NEW: Custom message
                'data' => [
                    'booking_id' => $booking->id,
                    'car' => $booking->mobil_test_drive,
                    'status' => $booking->status,
                    'assigned_spv' => $selectedSPV->name, // âœ… Nama SPV yang dipilih
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('âŒ Validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('âŒ Booking error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Store Pameran/Movex Booking
    private function storePameranBooking(Request $request)
    {
        try {
            Log::info('ðŸŽª Pameran booking request');

            $validated = $request->validate([
                'car' => 'required|string|max:100',
                'sales_user_id' => 'required|exists:users,id',
                'pic_name' => 'required|string|max:100',
                'pic_phone' => 'required|string|max:15',
                'pic_email' => 'required|email|max:100',
                'target_prospect' => 'required|string',
                'event_date' => 'required|date',
                'event_location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ]);

            Log::info('âœ… Pameran validation passed');

            // Get random supervisor and security
            $supervisor = Supervisor::inRandomOrder()->first();
            $security = Security::inRandomOrder()->first();

            if (!$supervisor || !$security) {
                Log::error('âŒ No staff available');
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, staff tidak tersedia saat ini'
                ], 400);
            }

            $booking = PameranBooking::create([
                'nama_pic' => $validated['pic_name'],
                'nomor_telepon' => $validated['pic_phone'],
                'email' => $validated['pic_email'],
                'mobil' => $validated['car'],
                'target_prospect' => $validated['target_prospect'],
                'tanggal_booking' => now()->toDateString(),
                'tanggal_acara' => $validated['event_date'],
                'lokasi_acara' => $validated['event_location'],
                'tanggal_mulai' => $validated['start_date'],
                'tanggal_selesai' => $validated['end_date'],
                'status' => 'Menunggu',
                'supervisor_id' => $supervisor->id,
                'security_id' => $security->id,
                'sales_user_id' => $validated['sales_user_id'], // âœ… NEW
                'booking_type' => 'pameran'
            ]);

            Log::info('âœ… Pameran booking created:', ['id' => $booking->id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking Pameran/Movex berhasil! Menunggu approval SPV.',
                'data' => [
                    'booking_id' => $booking->id,
                    'car' => $booking->mobil,
                    'status' => $booking->status,
                    'assigned_spv' => $supervisor->nama_lengkap,
                    'assigned_security' => $security->nama_lengkap,
                    'event_date' => $booking->formatted_event_date,
                    'duration' => $booking->formatted_start_date . ' - ' . $booking->formatted_end_date
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('âŒ Pameran validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('âŒ Pameran booking error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get SPV List untuk Sales Booking Form
     * PUBLIC: Tidak perlu auth karena diakses dari welcome page
     */
    public function getSPVList(Request $request)
    {
        try {
            // Get semua user dengan role SPV
            $spvList = \App\Models\User::where('role', 'spv')
                ->select('id', 'name', 'email')
                ->orderBy('name', 'asc')
                ->get()
                ->map(function ($spv) {
                    return [
                        'id' => $spv->id,
                        'name' => $spv->name,
                        'email' => $spv->email
                    ];
                });

            Log::info('âœ… SPV List loaded:', [
                'count' => $spvList->count(),
                'spvs' => $spvList->toArray()
            ]);

            return response()->json([
                'success' => true,
                'data' => $spvList
            ]);
        } catch (\Exception $e) {
            Log::error('âŒ Error loading SPV list: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar SPV',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Update Booking StatusRole-based status update dengan validation
    public function updateStatus(Request $request, $id)
    {
        try {
            $user = Auth::user();

            // ✅ UPDATED: Include "Sedang Pameran" in validation
            $validated = $request->validate([
                'status' => [
                    'required',
                    'in:Menunggu,Diproses,Dikonfirmasi,Sedang test drive,Sedang Pameran,Selesai,Perawatan,Dibatalkan'
                ],
                'booking_type' => 'required|in:test_drive,pameran'
            ]);

            // Tentukan model berdasarkan booking_type dari request
            if ($validated['booking_type'] === 'pameran') {
                $booking = PameranBooking::findOrFail($id);
                $bookingModel = 'pameran';
            } else {
                $booking = TestDriveBooking::findOrFail($id);
                $bookingModel = 'test_drive';
            }

            Log::info('🔄 Update Status Request:', [
                'booking_id' => $id,
                'booking_type' => $validated['booking_type'],
                'model_used' => $bookingModel,
                'old_status' => $booking->status,
                'new_status' => $validated['status'],
                'user_role' => $user->role
            ]);

            // ✅ NEW: Validate status based on booking type
            if ($validated['booking_type'] === 'pameran' && $validated['status'] === 'Sedang test drive') {
                return response()->json([
                    'success' => false,
                    'message' => 'Status "Sedang test drive" tidak valid untuk booking Pameran/Movex.' . "\n" .
                                 'Gunakan status "Sedang Pameran" untuk booking jenis ini.'
                ], 400);
            }

            if ($validated['booking_type'] === 'test_drive' && $validated['status'] === 'Sedang Pameran') {
                return response()->json([
                    'success' => false,
                    'message' => 'Status "Sedang Pameran" tidak valid untuk booking Test Drive.' . "\n" .
                                 'Gunakan status "Sedang test drive" untuk booking jenis ini.'
                ], 400);
            }

            // SPV Validation
            if ($user->role === 'spv') {
                // SPV hanya bisa update booking dengan status "Menunggu"
                if ($booking->status !== 'Menunggu') {
                    return response()->json([
                        'success' => false,
                        'message' => 'SPV hanya dapat approve/cancel booking dengan status "Menunggu".' . "\n\n" .
                            'Status booking saat ini: "' . $booking->status . '"'
                    ], 403);
                }

                // SPV hanya bisa set "Diproses" (approve) atau "Dibatalkan" (cancel)
                if (!in_array($validated['status'], ['Diproses', 'Dibatalkan'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'SPV hanya dapat:\n' .
                            '✅ Approve ke "Diproses"\n' .
                            '❌ Cancel ke "Dibatalkan"\n\n' .
                            'Status yang dipilih: "' . $validated['status'] . '"'
                    ], 403);
                }
            }
            // Branch Manager Validation
            elseif ($user->role === 'branch_manager') {
                // Branch Manager hanya bisa update booking dengan status "Diproses"
                if (!in_array($booking->status, ['Diproses', 'Dikonfirmasi'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Branch Manager hanya dapat mengubah booking dengan status "Diproses" atau "Dikonfirmasi".' . "\n\n" .
                            'Status booking saat ini: "' . $booking->status . '"'
                    ], 403);
                }

                // Branch Manager hanya bisa set "Dikonfirmasi" atau "Dibatalkan"
                if (!in_array($validated['status'], ['Dikonfirmasi', 'Dibatalkan'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Branch Manager hanya dapat:\n' .
                            '✅ Approve ke "Dikonfirmasi"\n' .
                            '❌ Disapprove/Cancel ke "Dibatalkan"'
                    ], 403);
                }

                // Validate based on action
                if ($validated['status'] === 'Dikonfirmasi') {
                    // Approve: hanya dari "Diproses"
                    if ($booking->status !== 'Diproses') {
                        return response()->json([
                            'success' => false,
                            'message' => 'Branch Manager hanya dapat approve booking dengan status "Diproses".' . "\n\n" .
                                'Status booking saat ini: "' . $booking->status . '"'
                        ], 403);
                    }
                } elseif ($validated['status'] === 'Dibatalkan') {
                    // Cancel: dari "Diproses" atau "Dikonfirmasi"
                    if (!in_array($booking->status, ['Diproses', 'Dikonfirmasi'])) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Branch Manager hanya dapat cancel booking dengan status "Diproses" atau "Dikonfirmasi".' . "\n\n" .
                                'Status booking saat ini: "' . $booking->status . '"'
                        ], 403);
                    }
                }
            }
            // ✅ UPDATED: Security Validation - Support both status types
            elseif ($user->role === 'security') {
                // Determine valid "in progress" status based on booking type
                $validInProgressStatus = ($validated['booking_type'] === 'pameran') 
                    ? 'Sedang Pameran' 
                    : 'Sedang test drive';

                // Security hanya bisa update booking yang sudah dikonfirmasi BM
                $allowedCurrentStatuses = ['Dikonfirmasi', $validInProgressStatus, 'Selesai', 'Perawatan'];
                
                if (!in_array($booking->status, $allowedCurrentStatuses)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Security hanya dapat mengubah status mobil yang sudah dikonfirmasi Branch Manager.' . "\n\n" .
                            'Status booking saat ini: "' . $booking->status . '"'
                    ], 403);
                }

                // Security hanya bisa set status mobil berdasarkan tipe booking
                $allowedNewStatuses = [$validInProgressStatus, 'Selesai', 'Perawatan'];
                
                if (!in_array($validated['status'], $allowedNewStatuses)) {
                    $statusLabel = ($validated['booking_type'] === 'pameran') 
                        ? 'Sedang Pameran' 
                        : 'Sedang Test Drive';
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Security hanya dapat mengubah status mobil ke:\n' .
                            '🚗 ' . $statusLabel . '\n' .
                            '✅ Selesai\n' .
                            '🔧 Perawatan'
                    ], 403);
                }
            }
            // Admin: Full access
            elseif ($user->role === 'admin') {
                // Admin can set any status, but still validate booking type consistency
                // (already handled above)
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki izin untuk mengubah status booking'
                ], 403);
            }

            $oldStatus = $booking->status;
            $booking->update(['status' => $validated['status']]);

            Log::info('✅ Status updated:', [
                'booking_id' => $id,
                'booking_type' => $booking instanceof TestDriveBooking ? 'test_drive' : 'pameran',
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'updated_by' => $user->email,
                'user_role' => $user->role
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update Customer Data (SPV/Admin only)

    public function updateCustomer(Request $request)
    {
        try {
            $validated = $request->validate([
                'original_email' => 'required|email',
                'nama_lengkap' => 'required|string|max:100',
                'nomor_telepon' => 'required|string|max:15',
                'email' => 'required|email|max:100',
                'no_ktp' => 'required|string|size:16',
                'alamat' => 'required|string',
                'supervisor_id' => 'nullable|exists:supervisors,id',
            ]);

            $updated = TestDriveBooking::where('email', $validated['original_email'])
                ->update([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'nomor_telepon' => $validated['nomor_telepon'],
                    'email' => $validated['email'],
                    'no_ktp' => $validated['no_ktp'],
                    'alamat' => $validated['alamat'],
                    'supervisor_id' => $validated['supervisor_id'],
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Data customer berhasil diupdate!',
                'updated_count' => $updated
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete Customer (SPV/Admin only)
    public function deleteCustomer(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email'
            ]);

            $deleted = TestDriveBooking::where('email', $validated['email'])->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer dan semua bookingnya berhasil dihapus!',
                'deleted_count' => $deleted
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get Notifications

    public function getNotifications()
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => true, 'data' => []]);
            }

            $bookings = TestDriveBooking::where('email', Auth::user()->email)
                ->where('updated_at', '>=', now()->subDays(7))
                ->whereIn('status', ['Dikonfirmasi', 'Dibatalkan'])
                ->orderBy('updated_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'message' => "Booking {$booking->mobil_test_drive} - Status: {$booking->status}",
                        'type' => $booking->status === 'Dikonfirmasi' ? 'approved' : 'rejected',
                        'created_at' => $booking->updated_at->format('Y-m-d H:i:s')
                    ];
                });

            return response()->json(['success' => true, 'data' => $bookings]);
        } catch (\Exception $e) {
            Log::error('Error getting notifications: ' . $e->getMessage());
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    // Check New Notifications
    public function getNewNotifications()
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => true, 'data' => []]);
            }

            $notifications = TestDriveBooking::where('email', Auth::user()->email)
                ->where('updated_at', '>=', now()->subMinutes(5))
                ->whereIn('status', ['Dikonfirmasi', 'Dibatalkan'])
                ->orderBy('updated_at', 'desc')
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'message' => "Booking {$booking->mobil_test_drive} - Status: {$booking->status}",
                        'type' => $booking->status === 'Dikonfirmasi' ? 'approved' : 'rejected'
                    ];
                });

            return response()->json(['success' => true, 'data' => $notifications]);
        } catch (\Exception $e) {
            Log::error('Error getting new notifications: ' . $e->getMessage());
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    // Mark Notification as Read

    public function markNotificationRead($id)
    {
        try {
            TestDriveBooking::findOrFail($id);
            return response()->json(['success' => true, 'message' => 'Notification marked as read']);
        } catch (\Exception $e) {
            Log::error('Error marking notification: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error marking notification'], 500);
        }
    }
    /**
     * ✅ NEW: Get real-time vehicle status with detailed logic
     * PUBLIC: Accessible without authentication
     */
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

            $vehicleStatus = [];

            foreach ($vehicles as $vehicle) {
                // Test Drive Booking
                $testDriveBooking = TestDriveBooking::where('mobil_test_drive', $vehicle)
                    ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
                    ->whereIn('status', [
                        'Menunggu',
                        'Diproses',
                        'Dikonfirmasi',
                        'Sedang test drive',
                        'Perawatan'
                    ])
                    ->orderBy('created_at', 'desc')
                    ->first();

                // Pameran Booking
                $pameranBooking = PameranBooking::where('mobil', $vehicle)
                    ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
                    ->whereIn('status', [
                        'Menunggu',
                        'Diproses',
                        'Dikonfirmasi',
                        'Sedang Pameran',
                        'Perawatan'
                    ])
                    ->orderBy('created_at', 'desc')
                    ->first();

                // ✅ NEW: Prioritas - Cek booking mana yang lebih aktif
                $activeBooking = null;
                $bookingType = null;

                // Jika ada pameran booking, prioritaskan itu
                if ($pameranBooking) {
                    $activeBooking = $pameranBooking;
                    $bookingType = 'pameran';
                } elseif ($testDriveBooking) {
                    $activeBooking = $testDriveBooking;
                    $bookingType = 'test_drive';
                }

                if ($activeBooking) {
                    // ✅ Status mapping dengan informasi booking type
                    switch ($activeBooking->status) {
                        case 'Menunggu':
                        case 'Diproses':
                        case 'Dikonfirmasi':
                            // 🟡 Sudah dibooking
                            $statusText = $bookingType === 'pameran'
                                ? 'Dibooking untuk Pameran/Movex'
                                : 'Dibooking untuk Test Drive';

                            $vehicleStatus[$vehicle] = [
                                'available' => false,
                                'status' => $statusText,
                                'status_code' => 'booked',
                                'booking_type' => $bookingType,
                                'booking_id' => $activeBooking->id,
                                'booking_status' => $activeBooking->status
                            ];
                            break;

                        case 'Sedang test drive':
                            $vehicleStatus[$vehicle] = [
                                'available' => false,
                                'status' => 'Mobil Tidak Tersedia',
                                'status_code' => 'in_use',
                                'booking_type' => 'test_drive',
                                'booking_id' => $activeBooking->id,
                                'booking_status' => $activeBooking->status
                            ];
                            break;

                        case 'Sedang Pameran':
                            $vehicleStatus[$vehicle] = [
                                'available' => false,
                                'status' => 'Mobil Tidak Tersedia',
                                'status_code' => 'in_use',
                                'booking_type' => 'pameran',
                                'booking_id' => $activeBooking->id,
                                'booking_status' => $activeBooking->status
                            ];
                            break;

                        case 'Perawatan':
                            $vehicleStatus[$vehicle] = [
                                'available' => false,
                                'status' => 'Mobil Belum Tersedia (Masih Tahap Perawatan)',
                                'status_code' => 'maintenance',
                                'booking_type' => $bookingType,
                                'booking_id' => $activeBooking->id,
                                'booking_status' => $activeBooking->status
                            ];
                            break;

                        default:
                            $vehicleStatus[$vehicle] = [
                                'available' => true,
                                'status' => 'Tersedia',
                                'status_code' => 'available'
                            ];
                            break;
                    }
                } else {
                    // ✅ Tidak ada booking aktif = Tersedia
                    $vehicleStatus[$vehicle] = [
                        'available' => true,
                        'status' => 'Tersedia',
                        'status_code' => 'available'
                    ];
                }
            }

            Log::info('✅ Vehicle status loaded:', $vehicleStatus);

            return response()->json([
                'success' => true,
                'data' => $vehicleStatus
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Error loading vehicle status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat status kendaraan',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}