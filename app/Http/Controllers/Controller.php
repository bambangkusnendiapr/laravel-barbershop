<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function unsetCart()
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
