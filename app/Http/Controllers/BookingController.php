<?php

namespace App\Http\Controllers;

use App\Models\TestDriveBooking;
use App\Models\PameranBooking;
use App\Models\User;
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

            // ✅ FIXED: Filter based on user role
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
                // ✅ FIXED: SPV filter directly by supervisor_user_id
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

                Log::info('SPV Filter Applied:', [
                    'spv_user_id' => $user->id,
                    'spv_name' => $user->name
                ]);
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
                        'spv' => $booking->supervisor->name ?? '-',  // ✅ Changed from nama_lengkap to name
                        'security' => $booking->security->name ?? '-',  // ✅ Changed from nama_lengkap to name
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
                // ✅ FIXED: SPV filter directly by supervisor_user_id
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
                        'spv' => $booking->supervisor->name ?? '-',  // ✅ Changed from nama_lengkap to name
                        'security' => $booking->security->name ?? '-',  // ✅ Changed from nama_lengkap to name
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

            Log::info('✅ Bookings loaded successfully:', [
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

    // ✅ UPDATED: Get Staff Data from users table
    public function getStaffData()
    {
        try {
            // Get SPV from users table
            $supervisors = User::where('role', 'spv')
                ->select('id', 'name', 'email')
                ->orderBy('name')
                ->get()
                ->map(function ($spv) {
                    return [
                        'id' => $spv->id,
                        'name' => $spv->name,
                        'position' => 'SPV',
                        'phone' => $spv->email
                    ];
                });

            // Get Security from users table
            $securities = User::where('role', 'security')
                ->select('id', 'name', 'email')
                ->orderBy('name')
                ->get()
                ->map(function ($sec) {
                    return [
                        'id' => $sec->id,
                        'name' => $sec->name,
                        'position' => 'Security',
                        'phone' => $sec->email
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
                        'assignedSPV' => $booking->supervisor->name ?? '-',  // ✅ Changed from nama_lengkap to name
                        'assignedSecurity' => $booking->security->name ?? '-',  // ✅ Changed from nama_lengkap to name
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

                        Log::info("✅ Loaded checksheet for {$name}:", [
                            'email' => $customer['email'],
                            'count' => count($customer['checksheetSummary']),
                            'summaries' => $customer['checksheetSummary']
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error("❌ Failed to load checksheet for {$name}: " . $e->getMessage());
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

    // ✅ UPDATED: Store Manual Booking (SPV/Admin Only)
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
                'supervisor_user_id' => 'required|exists:users,id',  // ✅ Changed from supervisor_id
                'security_user_id' => 'nullable|exists:users,id',  // ✅ Changed from security_id
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

    // ✅ UPDATED: Store Booking from Welcome Page (Sales)
    public function store(Request $request)
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('❌ Unauthenticated booking attempt from IP: ' . $request->ip());
                return response()->json([
                    'success' => false,
                    'message' => '🔒 Anda harus login terlebih dahulu!\n\n' .
                        'Silakan login dengan akun Sales untuk melakukan booking.\n\n' .
                        '📧 Email: sales@toyota.com\n' .
                        '🔑 Password: sales123'
                ], 401);
            }

            // Check if user is Sales or Admin
            $user = Auth::user();
            if (!in_array($user->role, ['sales', 'admin'])) {
                Log::warning('❌ Unauthorized booking attempt', [
                    'user_email' => $user->email,
                    'user_role' => $user->role,
                    'ip' => $request->ip()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => '⚠️ Akses Ditolak!\n\n' .
                        'Hanya akun Sales yang dapat melakukan booking dari halaman ini.\n\n' .
                        '👤 Role Anda saat ini: ' . strtoupper($user->role) . '\n' .
                        '✅ Role yang dibutuhkan: SALES atau ADMIN\n\n' .
                        'Silakan hubungi administrator jika Anda memerlukan akses.'
                ], 403);
            }

            Log::info('🚀 Booking request received:', $request->all());

            // Check booking type
            $bookingType = $request->input('booking_type', 'test_drive');

            if ($bookingType === 'pameran') {
                return $this->storePameranBooking($request);
            }

            // Test Drive validation
            $validated = $request->validate([
                'car' => 'required|string|max:100',
                'sales_user_id' => 'required|exists:users,id',
                'sales_name' => 'required|string|max:100',
                'sales_phone' => 'required|string|max:15',
                'customer_name' => 'required|string|max:100',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:100',
                'ktp' => 'required|string|size:16',
                'test_drive_time' => 'required',
                'test_drive_location' => 'required|string|max:255'
            ]);

            // Get SPV yang dipilih sales
            $selectedSPV = User::findOrFail($validated['sales_user_id']);

            if ($selectedSPV->role !== 'spv') {
                return response()->json([
                    'success' => false,
                    'message' => 'User yang dipilih bukan SPV!'
                ], 400);
            }

            Log::info('✅ Validation passed');
            Log::info('✅ Supervisor assigned:', [
                'supervisor_user_id' => $selectedSPV->id,
                'spv_name' => $selectedSPV->name
            ]);

            // ✅ FIXED: Create booking with supervisor_user_id
            $booking = TestDriveBooking::create([
                'nama_lengkap' => $validated['customer_name'],
                'nomor_telepon' => $validated['phone'],
                'email' => $validated['email'],
                'no_ktp' => $validated['ktp'],
                'alamat' => $validated['test_drive_location'],
                'mobil_test_drive' => $validated['car'],
                'tanggal_booking' => now()->toDateString(),
                'status' => 'Menunggu',
                'supervisor_user_id' => $selectedSPV->id,  // ✅ Changed from supervisor_id
                'security_user_id' => null,  // ✅ Changed from security_id
                'sales_user_id' => $validated['sales_user_id'],
                'sales_name' => $validated['sales_name'],
                'sales_phone' => $validated['sales_phone'],
                'test_drive_time' => $validated['test_drive_time'],
                'test_drive_location' => $validated['test_drive_location'],
                'booking_type' => 'test_drive'
            ]);

            Log::info('✅ Booking created:', ['id' => $booking->id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat dan dikirimkan ke Supervisor ' . $selectedSPV->name . '!',
                'data' => [
                    'booking_id' => $booking->id,
                    'car' => $booking->mobil_test_drive,
                    'status' => $booking->status,
                    'assigned_spv' => $selectedSPV->name,
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('❌ Booking error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // ✅ UPDATED: Store Pameran/Movex Booking
    private function storePameranBooking(Request $request)
    {
        try {
            Log::info('🎪 Pameran booking request');

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

            Log::info('✅ Pameran validation passed');

            // Get SPV from sales_user_id
            $selectedSPV = User::findOrFail($validated['sales_user_id']);

            if ($selectedSPV->role !== 'spv') {
                return response()->json([
                    'success' => false,
                    'message' => 'User yang dipilih bukan SPV!'
                ], 400);
            }

            // ✅ FIXED: Create pameran booking with supervisor_user_id
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
                'supervisor_user_id' => $selectedSPV->id,  // ✅ Changed from supervisor_id
                'security_user_id' => null,  // ✅ Changed from security_id
                'sales_user_id' => $validated['sales_user_id'],
                'booking_type' => 'pameran'
            ]);

            Log::info('✅ Pameran booking created:', ['id' => $booking->id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking Pameran/Movex berhasil! Menunggu approval SPV.',
                'data' => [
                    'booking_id' => $booking->id,
                    'car' => $booking->mobil,
                    'status' => $booking->status,
                    'assigned_spv' => $selectedSPV->name,
                    'event_date' => $booking->formatted_event_date,
                    'duration' => $booking->formatted_start_date . ' - ' . $booking->formatted_end_date
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Pameran validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('❌ Pameran booking error: ' . $e->getMessage());

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
            $spvList = User::where('role', 'spv')
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

            Log::info('✅ SPV List loaded:', [
                'count' => $spvList->count(),
                'spvs' => $spvList->toArray()
            ]);

            return response()->json([
                'success' => true,
                'data' => $spvList
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Error loading SPV list: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar SPV',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Update Booking Status - Role-based status update dengan validation
    /**
     * Update Booking Status - Role-based status update dengan validation
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $user = Auth::user();

            // ✅ FIXED: booking_type jadi optional
            $validated = $request->validate([
                'status' => [
                    'required',
                    'in:Menunggu,Diproses,Dikonfirmasi,Sedang test drive,Sedang Pameran,Selesai,Perawatan,Dibatalkan'
                ],
                'booking_type' => 'nullable|in:test_drive,pameran'
            ]);

            // ✅ CRITICAL FIX: Auto-detect booking type from database if not provided
            $bookingType = $validated['booking_type'] ?? null;
            $booking = null;

            if (!$bookingType) {
                // Try Test Drive first
                $testDriveBooking = TestDriveBooking::find($id);
                if ($testDriveBooking) {
                    $booking = $testDriveBooking;
                    $bookingType = 'test_drive';
                } else {
                    // If not found, try Pameran
                    $pameranBooking = PameranBooking::find($id);
                    if ($pameranBooking) {
                        $booking = $pameranBooking;
                        $bookingType = 'pameran';
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Booking tidak ditemukan'
                        ], 404);
                    }
                }
            } else {
                // Booking type provided in request
                if ($bookingType === 'pameran') {
                    $booking = PameranBooking::findOrFail($id);
                } else {
                    $booking = TestDriveBooking::findOrFail($id);
                }
            }

            Log::info('📄 Update Status Request:', [
                'booking_id' => $id,
                'detected_booking_type' => $bookingType,
                'request_booking_type' => $validated['booking_type'] ?? 'auto-detected',
                'old_status' => $booking->status,
                'new_status' => $validated['status'],
                'user_role' => $user->role,
                'user_email' => $user->email
            ]);

            // ✅ FIXED: Validate status based on detected booking type
            if ($bookingType === 'pameran' && $validated['status'] === 'Sedang test drive') {
                return response()->json([
                    'success' => false,
                    'message' => '❌ Status "Sedang test drive" tidak valid untuk booking Pameran/Movex.' . "\n\n" .
                        '✅ Gunakan status "Sedang Pameran" untuk booking jenis ini.'
                ], 400);
            }

            if ($bookingType === 'test_drive' && $validated['status'] === 'Sedang Pameran') {
                return response()->json([
                    'success' => false,
                    'message' => '❌ Status "Sedang Pameran" tidak valid untuk booking Test Drive.' . "\n\n" .
                        '✅ Gunakan status "Sedang test drive" untuk booking jenis ini.'
                ], 400);
            }

            // ========================================
            // ROLE-BASED VALIDATION
            // ========================================

            // SPV Validation
            if ($user->role === 'spv') {
                if ($booking->status !== 'Menunggu') {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ SPV hanya dapat approve/cancel booking dengan status "Menunggu".' . "\n\n" .
                            '📌 Status booking saat ini: "' . $booking->status . '"' . "\n" .
                            '📌 Tipe booking: ' . ($bookingType === 'pameran' ? 'Pameran/Movex' : 'Test Drive')
                    ], 403);
                }

                if (!in_array($validated['status'], ['Diproses', 'Dibatalkan'])) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ SPV hanya dapat:' . "\n" .
                            '✅ Approve ke "Diproses"' . "\n" .
                            '❌ Cancel ke "Dibatalkan"' . "\n\n" .
                            '📌 Status yang dipilih: "' . $validated['status'] . '"'
                    ], 403);
                }
            }
            // Branch Manager Validation
            elseif ($user->role === 'branch_manager') {
                if (!in_array($booking->status, ['Diproses', 'Dikonfirmasi'])) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ Branch Manager hanya dapat mengubah booking dengan status "Diproses" atau "Dikonfirmasi".' . "\n\n" .
                            '📌 Status booking saat ini: "' . $booking->status . '"' . "\n" .
                            '📌 Tipe booking: ' . ($bookingType === 'pameran' ? 'Pameran/Movex' : 'Test Drive')
                    ], 403);
                }

                if (!in_array($validated['status'], ['Dikonfirmasi', 'Dibatalkan'])) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ Branch Manager hanya dapat:' . "\n" .
                            '✅ Approve ke "Dikonfirmasi"' . "\n" .
                            '❌ Disapprove/Cancel ke "Dibatalkan"'
                    ], 403);
                }

                if ($validated['status'] === 'Dikonfirmasi') {
                    if ($booking->status !== 'Diproses') {
                        return response()->json([
                            'success' => false,
                            'message' => '⚠️ Branch Manager hanya dapat approve booking dengan status "Diproses".' . "\n\n" .
                                '📌 Status booking saat ini: "' . $booking->status . '"'
                        ], 403);
                    }
                } elseif ($validated['status'] === 'Dibatalkan') {
                    if (!in_array($booking->status, ['Diproses', 'Dikonfirmasi'])) {
                        return response()->json([
                            'success' => false,
                            'message' => '⚠️ Branch Manager hanya dapat cancel booking dengan status "Diproses" atau "Dikonfirmasi".' . "\n\n" .
                                '📌 Status booking saat ini: "' . $booking->status . '"'
                        ], 403);
                    }
                }
            }
            // Security Validation
            elseif ($user->role === 'security') {
                $validInProgressStatus = ($bookingType === 'pameran')
                    ? 'Sedang Pameran'
                    : 'Sedang test drive';

                $allowedCurrentStatuses = ['Dikonfirmasi', $validInProgressStatus, 'Selesai', 'Perawatan'];

                if (!in_array($booking->status, $allowedCurrentStatuses)) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ Security hanya dapat mengubah status mobil yang sudah dikonfirmasi Branch Manager.' . "\n\n" .
                            '📌 Status booking saat ini: "' . $booking->status . '"' . "\n" .
                            '📌 Tipe booking: ' . ($bookingType === 'pameran' ? 'Pameran/Movex' : 'Test Drive') . "\n\n" .
                            '✅ Status yang diizinkan: Dikonfirmasi, ' . $validInProgressStatus . ', Selesai, Perawatan'
                    ], 403);
                }

                $allowedNewStatuses = [$validInProgressStatus, 'Selesai', 'Perawatan'];

                if (!in_array($validated['status'], $allowedNewStatuses)) {
                    $statusLabel = ($bookingType === 'pameran')
                        ? 'Sedang Pameran'
                        : 'Sedang Test Drive';

                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ Security hanya dapat mengubah status mobil ke:' . "\n" .
                            '🚗 ' . $statusLabel . "\n" .
                            '✅ Selesai' . "\n" .
                            '🔧 Perawatan'
                    ], 403);
                }
            }
            // Admin: Full access (no validation)
            elseif ($user->role === 'admin') {
                // Admin can set any status
                Log::info('✅ Admin full access granted');
            } else {
                return response()->json([
                    'success' => false,
                    'message' => '❌ Anda tidak memiliki izin untuk mengubah status booking'
                ], 403);
            }

            // ========================================
            // UPDATE STATUS
            // ========================================

            $oldStatus = $booking->status;
            $booking->update(['status' => $validated['status']]);

            Log::info('✅ Status updated successfully:', [
                'booking_id' => $id,
                'booking_type' => $bookingType,
                'model_class' => get_class($booking),
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'updated_by' => $user->email,
                'user_role' => $user->role,
                'timestamp' => now()->toDateTimeString()
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Status berhasil diupdate dari "' . $oldStatus . '" ke "' . $validated['status'] . '"!',
                'data' => [
                    'id' => $booking->id,
                    'booking_type' => $bookingType,
                    'old_status' => $oldStatus,
                    'new_status' => $validated['status'],
                    'updated_by' => $user->name,
                    'updated_at' => $booking->updated_at->format('d M Y H:i:s')
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation error in updateStatus:', [
                'booking_id' => $id,
                'errors' => $e->errors(),
                'user' => $user->email ?? 'Unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => '❌ Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('❌ Booking not found:', [
                'booking_id' => $id,
                'user' => $user->email ?? 'Unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => '❌ Booking dengan ID ' . $id . ' tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            Log::error('❌ Error updating status:', [
                'booking_id' => $id,
                'error_message' => $e->getMessage(),
                'error_line' => $e->getLine(),
                'error_file' => $e->getFile(),
                'stack_trace' => $e->getTraceAsString(),
                'user' => $user->email ?? 'Unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => '❌ Terjadi kesalahan saat update status: ' . $e->getMessage(),
                'error_detail' => config('app.debug') ? [
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ] : null
            ], 500);
        }
    }

    // ✅ UPDATED: Update Customer Data (SPV/Admin only)
    // âœ… FIXED: Update Customer Data
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
                'supervisor_user_id' => 'nullable|exists:users,id',
            ]);

            // âœ… Prepare update data - only include supervisor if provided
            $updateData = [
                'nama_lengkap' => $validated['nama_lengkap'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'email' => $validated['email'],
                'no_ktp' => $validated['no_ktp'],
                'alamat' => $validated['alamat'],
            ];

            // âœ… Only update supervisor if value is provided
            if (isset($validated['supervisor_user_id']) && !empty($validated['supervisor_user_id'])) {
                $updateData['supervisor_user_id'] = $validated['supervisor_user_id'];
            }

            $updated = TestDriveBooking::where('email', $validated['original_email'])
                ->update($updateData);

            Log::info('âœ… Customer updated successfully:', [
                'original_email' => $validated['original_email'],
                'new_email' => $validated['email'],
                'updated_count' => $updated
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data customer berhasil diupdate!',
                'updated_count' => $updated
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('âŒ Validation error updating customer:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('âŒ Error updating customer: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

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
     * Get real-time vehicle status with detailed logic
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

                // Prioritas - Cek booking mana yang lebih aktif
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
                    // Status mapping dengan informasi booking type
                    switch ($activeBooking->status) {
                        case 'Menunggu':
                        case 'Diproses':
                        case 'Dikonfirmasi':
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
                    // Tidak ada booking aktif = Tersedia
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

    /**
     * ✅ NEW: Update Pameran Booking (Admin/SPV Only)
     */
    public function updatePameranBooking(Request $request, $id)
    {
        try {
            $booking = PameranBooking::findOrFail($id);

            $validated = $request->validate([
                'nama_pic' => 'sometimes|string|max:100',
                'nomor_telepon' => 'sometimes|string|max:15',
                'email' => 'sometimes|email|max:100',
                'mobil' => 'sometimes|string|max:100',
                'target_prospect' => 'sometimes|string',
                'tanggal_acara' => 'sometimes|date',
                'lokasi_acara' => 'sometimes|string|max:255',
                'tanggal_mulai' => 'sometimes|date',
                'tanggal_selesai' => 'sometimes|date|after_or_equal:tanggal_mulai',
                'supervisor_user_id' => 'sometimes|exists:users,id',  // ✅ Changed from supervisor_id
                'security_user_id' => 'sometimes|exists:users,id',  // ✅ Changed from security_id
                'status' => 'sometimes|in:Menunggu,Diproses,Dikonfirmasi,Sedang Pameran,Selesai,Perawatan,Dibatalkan'
            ]);

            $booking->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Booking Pameran berhasil diupdate!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating pameran booking: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
