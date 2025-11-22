<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment\Apartment;
use App\Models\Booking\Booking;
use App\Models\Hotel\Hotel;
use Auth;
use Carbon\Carbon;
use Redirect;
use Session;

use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Notification;

class HotelsController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans
        MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$isProduction = false; // ganti true kalau sudah live
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }

    public function rooms($id)
    {
        $getRooms = Apartment::where('hotel_id', $id)
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        return view('hotels.rooms', compact('getRooms'));
    }

    public function roomsDetails($id)
    {
        $getRoom = Apartment::find($id);
        return view('hotels.roomdetails', compact('getRoom'));
    }

    public function roomBooking(Request $request, $id)
    {
        $room = Apartment::find($id);
        $hotel = Hotel::find($room->hotel_id);

        $check_in = Carbon::parse($request->check_in);
        $check_out = Carbon::parse($request->check_out);

        // check tanggal harus masa depan
        if ($check_in->isPast() || $check_out->isPast()) {
            return back()->with(['error_dates' => 'Invalid date: pick future dates.']);
        }

        // check-out harus lebih besar dari check-in
        if ($check_out->lte($check_in)) {
            return back()->with(['error' => 'Check-out must be after check-in.']);
        }

        $days = $check_in->diffInDays($check_out);
        $totalPrice = $days * $room->price;

        $booking = Booking::create([
            "name"        => $request->name,
            "email"       => $request->email,
            "phone_number"=> $request->phone_number,
            "check_in"    => $check_in,
            "check_out"   => $check_out,
            "days"        => $days,
            "price"       => $totalPrice,
            "user_id"     => Auth::user()->id,
            "room_name"   => $room->name,
            "hotel_name"  => $hotel->name,
            "status"      => "Processing"
        ]);

        // simpan booking id untuk pembayaran
        Session::put('booking_id', $booking->id);
        Session::put('price', $totalPrice);

        return Redirect::route('hotel.pay');
    }

    // ============================================================
    //                        MIDTRANS
    // ============================================================

    public function payWithMidtrans()
{
    $bookingId = Session::get('booking_id');
    $booking = Booking::findOrFail($bookingId);

    // Ambil room berdasarkan nama yang tersimpan di booking
    $room = Apartment::where('name', $booking->room_name)->first();

    $totalPrice = $booking->price; // ini yang lo butuhin di view

    $params = [
        'transaction_details' => [
            'order_id' => 'BOOK-' . $booking->id . '-' . time(),
            'gross_amount' => $totalPrice,
        ],
        'customer_details' => [
            'first_name' => $booking->name,
            'email' => $booking->email,
            'phone' => $booking->phone_number,
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('Hotels.pay', compact('snapToken', 'booking', 'room', 'totalPrice'));
}


    public function midtransCallback(Request $request)
    {
        $notification = new Notification();
        $orderId = $notification->order_id;

        // Ambil ID booking dari order_id
        // Format: BOOK-{id}-{timestamp}
        $bookingId = explode('-', $orderId)[1];

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Status Midtrans
        $transaction = $notification->transaction_status;
        $fraud = $notification->fraud_status;

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $booking->status = 'challenge';
            } else {
                $booking->status = 'success';
            }
        } else if ($transaction == 'settlement') {
            $booking->status = 'success';
        } else if ($transaction == 'Processing') {
            $booking->status = 'Processing';
        } else if ($transaction == 'deny') {
            $booking->status = 'deny';
        } else if ($transaction == 'expire') {
            $booking->status = 'expired';
        } else if ($transaction == 'cancel') {
            $booking->status = 'cancel';
        }

        $booking->save();

        return response()->json(['message' => 'Callback processed']);
    }

    public function success()
    {
        Session::forget('booking_id');
        Session::forget('price');
        return view('Hotels.success');
    }
}
