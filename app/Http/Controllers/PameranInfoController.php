<?php

namespace App\Http\Controllers;

use App\Models\PameranBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PameranInfoController extends Controller
{

    // Display the pameran info page
    public function index()
    {
        return view('pameran-info');
    }

    // Get all approved pameran bookings (API endpoint)
    public function getPameranBookings(Request $request)
    {
        try {
            $query = PameranBooking::with(['supervisor', 'security', 'salesUser'])
                ->whereIn('status', [
                    'Dikonfirmasi',
                    'Diproses',
                    'Sedang Pameran',
                    'Perawatan',
                    'Selesai'
                ])
                ->orderBy('tanggal_booking', 'desc');

            // Filter by search
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pic', 'like', "%{$search}%")
                        ->orWhere('nomor_telepon', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('mobil', 'like', "%{$search}%")
                        ->orWhere('lokasi_acara', 'like', "%{$search}%");
                });
            }

            // Filter by status
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

            // Filter by date range
            if ($request->has('date_from') && !empty($request->date_from)) {
                $query->whereDate('tanggal_booking', '>=', $request->date_from);
            }
            if ($request->has('date_to') && !empty($request->date_to)) {
                $query->whereDate('tanggal_booking', '<=', $request->date_to);
            }

            $bookings = $query->get();

            return response()->json([
                'success' => true,
                'data' => $bookings->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'nama_pic' => $booking->nama_pic,
                        'nomor_telepon' => $booking->nomor_telepon,
                        'email' => $booking->email,
                        'mobil' => $booking->mobil,
                        'target_prospect' => $booking->target_prospect,
                        'tanggal_booking' => $booking->formatted_date,
                        'tanggal_mulai' => $booking->formatted_start_date,
                        'tanggal_selesai' => $booking->formatted_end_date,
                        'tanggal_acara' => $booking->formatted_event_date,
                        'lokasi_acara' => $booking->lokasi_acara,
                        'supervisor_name' => $booking->supervisor_name,
                        'security_name' => $booking->security_name,
                        'sales_name' => $booking->salesUser ? $booking->salesUser->name : '-',
                        'status' => $booking->status,
                        'created_at' => $booking->created_at->format('d M Y H:i'),
                    ];
                }),
                'total' => $bookings->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching pameran bookings: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data'
            ], 500);
        }
    }

    // Update status of pameran booking
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Sedang Pameran,Perawatan,Selesai'
            ]);

            $booking = PameranBooking::findOrFail($id);
            
            $oldStatus = $booking->status;
            $booking->status = $request->status;
            $booking->save();

            Log::info('Pameran booking status updated', [
                'booking_id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'updated_by' => Auth::user()?->name ?? 'Unknown'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'data' => $booking
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating pameran status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status'
            ], 500);
        }
    }

    // Get details of pameran booking
    public function show($id)
    {
        try {
            $booking = PameranBooking::with(['supervisor', 'security', 'salesUser'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $booking->id,
                    'nama_pic' => $booking->nama_pic,
                    'nomor_telepon' => $booking->nomor_telepon,
                    'email' => $booking->email,
                    'mobil' => $booking->mobil,
                    'target_prospect' => $booking->target_prospect,
                    'tanggal_booking' => $booking->formatted_date,
                    'tanggal_mulai' => $booking->formatted_start_date,
                    'tanggal_selesai' => $booking->formatted_end_date,
                    'tanggal_acara' => $booking->formatted_event_date,
                    'lokasi_acara' => $booking->lokasi_acara,
                    'supervisor_name' => $booking->supervisor_name,
                    'security_name' => $booking->security_name,
                    'sales_name' => $booking->salesUser ? $booking->salesUser->name : '-',
                    'status' => $booking->status,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching pameran booking details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
}