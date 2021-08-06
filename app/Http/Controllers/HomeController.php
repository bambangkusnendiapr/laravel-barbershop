<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        // dd(date('Y-m-d H:i:s'));
        // dd(Auth::user()->id);
        return view('home', [
            'locations' => Location::all(),
            'staff' => User::whereRoleIs('staff')->get(),
            'categories' => Category::all(),
        ]);
    }

    public function addOrder(Request $request)
    {
        // dd($request->datetime);
        $services = Service::whereIn('id', $request->service)->get();
        // dd($services->name);
        // foreach ($services as $service) {
        //     echo "-".$service->name." ".$service->price."<br>";
            
        // }
        // echo $services->sum('price'); die();

        $kode = 'KODE'.time();

        $order = Order::create([
            'code' => $kode,
            'customer' => Auth::user()->id,
            'staff' => $request->staff,
            'location_id' => $request->location,
            'date' => $request->datetime,
            'net' => $services->sum('price'),
            'tax' => 0,
            'gross' => $services->sum('price'),
        ]);

        foreach ($services as $service) {
            DB::table('order_service')->insert([
                'order_id' => $order->id,
                'service_id' => $service->id,
                'qty' => 1,
                'total' => $service->price,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // $order->service()->sync($request->service);

        return redirect()->route('booking', $kode);
    }

    public function checkBooking()
    {
        return view('check_booking',[
            'orders' => Order::all(),
        ]);
    }

    public function bookingCheck(Request $request)
    {
        return redirect()->route('booking', $request->code);
    }

    public function booking($kode)
    {
        $order = Order::where('code', $kode)->first();
        if(empty($order)) {
            return redirect('/');
        }
        // $order = Order::where('code', $kode)->first();
        // dd($order->client->email);
        return view('booking', [
            'locations' => Location::all(),
            'staff' => User::whereRoleIs('staff')->get(),
            'categories' => Category::all(),
            'order' => Order::where('code', $kode)->first(),
        ]);
    }

    public function lunas(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::find($id);
        $order->lunas = 'Lunas';
        $order->save();

        return redirect()->route('booking', $order->code);
    }
}
