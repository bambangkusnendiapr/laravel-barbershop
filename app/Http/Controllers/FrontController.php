<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Category;
use App\Models\User;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use File;

class FrontController extends Controller
{
    public function index()
    {
        // $order = Order::find(1);
        // if($order->date->addHour(5) < now()) {
        //     return "hapus " . $order->date . " " . $order->date->addHour(5) . " " . now();
        // } else {
        //     return "masih " . $order->date . " " . $order->date->addHour(5) . " " . now();
        // }
        // echo now()->format('d F Y H:i');
        // echo "<br>";
        // echo now();
        // echo "<br>";
        // echo now()->addHour(5);
        // echo "<br>";
        // echo now()->addMinutes(5);
        // die();

        return view('front', [
            'locations' => Location::all(),
        ]);
    }

    public function locationToService($id)
    {
        $location = Location::find($id);
        if(!$location) {
            abort(404);
        }

        $cart_location = session()->get('cart_location');

        //jika tidak ada cart maka tambahkan
        if(!$cart_location) {
            $cart_location = [
                    "lokasi" => [
                        "id" => $location->id,
                        "name" => $location->name,
                    ]
            ];
            session()->put('cart_location', $cart_location);
        } else {
            // jika ada cart
            $cart_location = session()->get('cart_location');

            unset($cart_location);
            session()->put('cart_location');

            $cart_location = [
                "lokasi" => [
                    "id" => $location->id,
                    "name" => $location->name,
                ]
            ];
            session()->put('cart_location', $cart_location);
        }

        // $cart_location = session()->get('cart_location');

        //     unset($cart_location);
        //     session()->put('cart_location');

        return view('service', [
            'categories' => Category::all(),
        ]);
    }

    public function addToCart($id)
    {
        //sumber cart
        // https://webmobtuts.com/backend-development/creating-a-shopping-cart-with-laravel/

        // $cart = session()->get('cart');

        // unset($cart);
        // session()->put('cart');
        // dd(session('cart'));
        $service = Service::find($id);
        if(!$service) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $service->name,
                        "quantity" => 1,
                        "price" => $service->price,
                        "duration" => $service->duration,
                        "time" => $service->time,
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with(['success' => 'Service Successfully Added']);
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with(['success' => 'Service Successfully Added']);
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $service->name,
            "quantity" => 1,
            "price" => $service->price,
            "duration" => $service->duration,
            "time" => $service->time,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with(['success' => 'Service Successfully Added']);
    }

    public function cart()
    {
        $cart = session()->get('cart');
        $cart_location = session()->get('cart_location');
        if(!$cart) {
            return redirect()->route('locationToService', $cart_location['lokasi']['id']);
        }
        return view('cart', [
            'categories' => Category::all(),
        ]);
    }

    public function deleteService($id)
    {
        // dd($id);
        $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->back();
    }

    public function update(Request $request)
    {
        // dd($request->all());
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
    }

    public function staff()
    {
        $cart_location = session()->get('cart_location');
        // $cart_staff = session()->get('cart_staff');
        // dd($cart_staff['date_time']);
        // return $cart_location['lokasi']['id'];
        // $staf = User::whereRoleIs('staff')->where('location_id', $cart_location['lokasi']['id'])->get();
        // return $staf;
        return view('staff', [
            'staffs' => User::whereRoleIs('staff')->where('location_id', $cart_location['lokasi']['id'])->get(),
        ]);
    }

    public function addStaff(Request $request)
    {
        $orders = Order::where('lunas', '!=', 'Approved')->get();
        $i = 0;
        if($request->date) {
            foreach($orders as $order) {
                $cek_date = new \DateTime($request->date);
                if($cek_date == $order->date && $request->staff == $order->staff) {
                    // dd($request->date);
                    return redirect()->back()->with(['warning' => 'Mohon Maaf! staff dan waktu yang anda pilih telah dibooking orang lain, silahkan pilih staff / waktu yang berbeda.']);
                }
                $i++;
            }
        }
        // $tanggal = new \DateTime($request->date);
        // echo $tanggal->format('Y-m-d');
        $namaStaff = User::find($request->staff);
        // dd($namaStaff);
        $cart_staff = session()->get('cart_staff');

        //jika tidak ada cart maka tambahkan
        if(!$cart_staff) {
            $cart_staff = [
                    'staf_id' => $request->staff,
                    'name' => $namaStaff->first_name,
                    'date_time' => new \DateTime($request->date),
                    'date' => $request->date,
            ];
            session()->put('cart_staff', $cart_staff);
        } else {
            // jika ada cart
            $cart_staff = session()->get('cart_staff');

            unset($cart_staff);
            session()->put('cart_staff');

            $cart_staff = [
                'staf_id' => $request->staff,
                'name' => $namaStaff->first_name,
                'date_time' => new \DateTime($request->date),
                'date' => $request->date,
            ];
            session()->put('cart_staff', $cart_staff);
        }

        return redirect()->route('customer');

        // dd(session('cart_staff'));
    }

    public function customer()
    {
        return view('customer');
    }

    public function addCustomer(Request $request)
    {
        $cart_customer = session()->get('cart_customer');

        //jika tidak ada cart maka tambahkan
        if(!$cart_customer) {
            $cart_customer = [
                    'first' => $request->first,
                    'last' => $request->last,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'note' => $request->note,
            ];
            session()->put('cart_customer', $cart_customer);
        } else {
            // jika ada cart
            $cart_customer = session()->get('cart_customer');

            unset($cart_customer);
            session()->put('cart_customer');

            $cart_customer = [
                'first' => $request->first,
                    'last' => $request->last,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'note' => $request->note,
            ];
            session()->put('cart_customer', $cart_customer);
        }

        return redirect()->route('detail');
        // dd(session('cart_customer'));
    }

    public function detail()
    {
        $cart = session()->get('cart');
        $cart_location = session()->get('cart_location');
        if(!$cart) {
            return redirect()->route('locationToService', $cart_location['lokasi']['id']);
        }
        return view('detail', [
            'payments' => Payment::all(),
        ]);
    }

    public function addPayment(Request $request)
    {
        $cart_staff = session()->get('cart_staff');
        $cart_customer = session()->get('cart_customer');
        $cart_location = session()->get('cart_location');
        $cart = session()->get('cart');

        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // dd($cart);

        $customer = User::where('email', $cart_customer['email'])->first();

        if($customer) {
            //jika customer sudah pesan dan belum bayar
            $order_customer = Order::where('customer', $customer->id)->first();
            if($order_customer && $order_customer->lunas == 'Order') {
                $order_customer->delete();
            }
        }

        //jika customer ada
        if($customer) {
            $customer->order++;
            $user_id = $customer->id;
            $customer->save();                  
        }else {
            $user = User::create([
                'location_id' => 1,
                'first_name' => $cart_customer['first'],
                'last_name' => $cart_customer['last'],
                'email' => $cart_customer['email'],
                'hp' => $cart_customer['phone'],
                'address' => $cart_customer['address'],
                'password' => bcrypt('password'),
            ]);

            $user->attachRole('customer');

            $user_id = $user->id;
        }

        $kode = 'KODE'.time();

        $order = Order::create([
            'code' => $kode,
            'customer' => $user_id,
            'staff' => $cart_staff['staf_id'],
            'location_id' => $cart_location['lokasi']['id'],
            'payment_id' => $request->payment,
            'date' => $cart_staff['date_time'],
            'net' => $total,
            'tax' => 0,
            'gross' => $total,
            'note' => $cart_customer['note'],
        ]);

        foreach($cart as $id => $details) {
            DB::table('order_service')->insert([
                'order_id' => $order->id,
                'service_id' => $id,
                'qty' => $details['quantity'],
                'total' => $details['quantity'] * $details['price'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->_unsetCart();

        return redirect()->route('detail_payment', $kode);
    }
    
    public function detail_payment($kode)
    {
        $order = Order::where('code', $kode)->first();
        if(!$order) {
            return redirect()->route('front');
        }
        return view('detail_payment', [
            'order' => $order,
        ]);
    }

    public function uploadBukti(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::find($id);

        if($request->hasFile('filefoto') == true)
        {
            $file = $request->file('filefoto');
            $filefoto = time()."".$file->getClientOriginalName();
            $file_ext  = $file->getClientOriginalExtension();
            
            $local_gambar = "img/bukti_transfer/".$order->images;
            if(File::exists($local_gambar))
            {
                File::delete($local_gambar);
            }

            $tujuan_upload = 'img/bukti_transfer/';
            $file->move($tujuan_upload,$filefoto);
            $order->images = $filefoto;
        }

        if($order->lunas == 'Approved') {
            $order->lunas = 'Approved';
        } else {
            $order->lunas = 'Payment';
        }

        $order->save();

        return redirect()->back();
    }

    public function unsetCart()
    {
        $this->_unsetCart();

        return redirect()->back();
    }

    public function search_code()
    {
        $search = false;
        if(request('search')) {
            $order = Order::where('code', request('search'))->first();
            if($order) {
                return view('detail_payment', [
                    'order' => $order,
                ]);
            }
            $search = true;
        }
        
        return view('search_code', [
            'search' => $search,
        ]);
    }

    private function _unsetCart()
    {
        $cart = session()->get('cart');
        $cart_location = session()->get('cart_location');
        $cart_staff = session()->get('cart_staff');
        $cart_customer = session()->get('cart_customer');

        unset($cart);
        unset($cart_location);
        unset($cart_staff);
        unset($cart_customer);

        session()->put('cart');
        session()->put('cart_location');
        session()->put('cart_staff');
        session()->put('cart_customer');
    }
}
