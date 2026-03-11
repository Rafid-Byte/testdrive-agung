<?php

namespace App\Http\Controllers;

use App\Models\PameranBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PameranInfoController extends Controller
{

    public function index()
    {
        return view('pameran-info');
    }

    public function getPameranBookings(Request $request)
    {
        try {
            $query = PameranBooking::with(['supervisor'])
                ->whereIn('status', [
                    'Dikonfirmasi',
                    'Diproses',
                    'Sedang Pameran',
                    'Perawatan',
                    'Selesai',
                    'Dibatalkan'
                ])
                ->orderBy('tanggal_booking', 'desc');

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

            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

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
                        'tanggal_acara_raw' => $booking->tanggal_acara ? \Carbon\Carbon::parse($booking->tanggal_acara)->format('Y-m-d') : null,
                        'lokasi_acara' => $booking->lokasi_acara,
                        'supervisor_name' => $booking->supervisor_name,
                        'security_name'   => '-',
                        'sales_name'      => $booking->supervisor_name,
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

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Sedang Pameran,Perawatan,Selesai'
            ]);

            $booking = PameranBooking::findOrFail($id);

            $currentUser = Auth::user();
            if ($currentUser?->role === 'security' && $booking->status === 'Diproses') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking ini belum dikonfirmasi Branch Manager. Status belum dapat diubah.'
                ], 403);
            }

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

    public function show($id)
    {
        try {
            $booking = PameranBooking::with(['supervisor'])
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
                    'tanggal_acara_raw' => $booking->tanggal_acara ? \Carbon\Carbon::parse($booking->tanggal_acara)->format('Y-m-d') : null,
                    'lokasi_acara' => $booking->lokasi_acara,
                    'supervisor_name' => $booking->supervisor_name,
                    'sales_name'      => $booking->supervisor_name,
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
