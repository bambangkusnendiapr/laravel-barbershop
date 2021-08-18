<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Location;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'visitors' => User::all(),
            'staff' => User::whereRoleIs('staff')->get(),
            'members' => User::whereRoleIs('customer')->get(),
            'orders' => Order::all(),
            'locations' => Location::all(),
            'services' => Service::all(),
        ]);
    }
}
