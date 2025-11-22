<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel\Hotel;
use App\Models\Apartment\Apartment;
use App\Models\Admin\Admin;
use App\Models\Booking\Booking;
use Illuminate\Support\Facades\Hash;
use Redirect;
use File;

class AdminsController extends Controller
{
    public function viewLogin(){
        return view('admins.login');
    }

    public function checkLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $remember_me = $request->has('remember_me');

    $credentials = $request->only('email', 'password');

    if (auth()->guard('admin')->attempt($credentials, $remember_me)) {
        return redirect()->route('admins.dashboard');
    }

    return redirect()->back()->withInput($request->only('email'))->with(['error' => 'Error logging in']);
}

    public function index(){

        $adminsCount=Admin::select()->count();
        $hotelsCount=Hotel::select()->count();
        $roomsCount=Apartment::select()->count();

    
        return view('admins.index', compact('adminsCount', 'hotelsCount', 'roomsCount'));
    }

    public function allAdmins(){

        $admins = Admin::select()->orderBy('id', 'asc')->get();

        return view('admins.alladmins', compact('admins'));

    }

    public function createAdmins(){

        return view('admins.createadmins');
    }

    public function storeAdmins(Request $request){

        $storeAdmins= Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($storeAdmins){

            return Redirect::route('admins.all')->with(['success' => 'Admin created successfully']);
        }
    }

    public function allHotels(){

        $hotels = Hotel::select()->orderBy('id', 'asc')->get();

        return view('admins.allhotels', compact('hotels'));

    }

    public function createHotels(){


        return view('admins.createhotels');

    }

    public function storeHotels(Request $request) {

        Request()->validate([
            'name' => "required|max:40",
            'image' =>"required|max:88",
            'description' =>"required",
            'location' => "required|max:40"
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeHotels= Hotel::create([
            'name' => $request->name,
            'image' => $myimage,
            'description' => $request->description,
            'location' => $request->location,
            
        ]);

        if ($storeHotels){

            return Redirect::route('hotels.all')->with(['success' => 'Hotel created successfully']);
        }
    }

    public function editHotels($id){

        $hotel = Hotel::find($id);

        return view('admins.edithotels', compact('hotel'));
    }

    public function updateHotels(Request $request, $id){

        Request()->validate([
            'name' => "required|max:40",
            'description' =>"required",
            'location' => "required|max:40"
        ]);
        $hotel = Hotel::find($id);
        $hotel->update($request->all());

        if ($hotel){
            return Redirect::route('hotels.all')->with(['update' => 'Hotels update successfully']);
        }
    }

    public function deleteHotels($id){

        $hotel = Hotel::find($id);
        if(File::exists(public_path('assets/images/' . $hotel->image))){
            File::delete(public_path('assets/images/' . $hotel->image));
        }else{
            //dd('File does not exists.');
        }
        $hotel->delete();

        if ($hotel){
            return Redirect::route('hotels.all')->with(['delete' => 'Hotels deleted successfully']);
        }
    }

    public function allRooms(){
        $rooms = Apartment::with('hotel')->orderBy('id', 'asc')->get();
        return view('admins.allrooms', compact('rooms'));
    }

    public function createRooms(){

        $hotels = Hotel::all();
        return view('admins.createrooms', compact('hotels'));
    }

    public function storeRooms(Request $request){


        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeRooms= Apartment::create([
            'name' => $request->name,
            'image' => $myimage,
            'max_persons' => $request->max_persons,
            'size' => $request->size,
            'view' => $request->view,
            'num_beds' => $request->num_beds,
            'price' => $request->price,
            'hotel_id' => $request->hotel_id,
            
        ]);

        if ($storeRooms){

            return Redirect::route('rooms.all')->with(['success' => 'Room created successfully']);
        }
    }

    public function deleteRooms($id){

        $room = Apartment::find($id);
        if(File::exists(public_path('assets/images/' . $room->image))){
            File::delete(public_path('assets/images/' . $room->image));
        }else{
            //dd('File does not exists.');
        }
        $room->delete();

        if ($room){
            return Redirect::route('rooms.all')->with(['delete' => 'Room deleted successfully']);
        }
    }

    public function allBookings(){
        $bookings = Booking::select()->orderBy('id', 'asc')->get();

        return view('admins.allbookings', compact('bookings'));
    }

    public function editStatus($id){

        $booking = Booking::find($id);

        return view('admins.editstatus', compact('booking'));

    }

    public function updateStatus(Request $request, $id){

        $status = Booking::find($id);
        $status->update($request->all());

        if ($status){
            return Redirect::route('bookings.all')->with(['update' => 'Status updated successfully']);
        }
    }

     public function deleteBookings($id){

        $booking = Booking::find($id);
        $booking->delete();

        if ($booking){
            return Redirect::route('bookings.all')->with(['delete' => 'Booking deleted successfully']);
        }
    }
}
