<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function pelayanan(Request $request)
    {
        $query = DB::table('order_service')
            ->join('services', 'order_service.service_id', '=', 'services.id')
            ->join('orders', 'order_service.order_id', '=', 'orders.id')
            ->select('order_service.*', 'services.*', 'orders.*')
            ->whereBetween('date', [$request->dari, $request->sampai])
            ->where('lunas', 'Approved')
            ->get();
        
        // dd($query);

        return view('admin.laporan.pelayanan', [
            'query' => $query,
            'services' => Service::all(),
            'orders' => Order::whereBetween('date', [$request->dari, $request->sampai])->where('lunas', 'Approved')->get(),
            'dari' => new \DateTime($request->dari),
            'sampai' => new \DateTime($request->sampai),
        ]);
    }

    public function staff(Request $request)
    {
        return view('admin.laporan.staff', [
            'staff' => User::whereRoleIs('staff')->get(),
            'orders' => Order::whereBetween('date', [$request->dari, $request->sampai])->where('lunas', 'Approved')->get(),
            'dari' => new \DateTime($request->dari),
            'sampai' => new \DateTime($request->sampai),
        ]);
    }
}
