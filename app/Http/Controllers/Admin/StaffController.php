<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.staff.index', [
            'staffs' => User::whereRoleIs('staff')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create', [
            'locations' => Location::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'first' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users,email'],
            'no' => 'required',
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

        $user = new User;
        $user->location_id = $request->location;
        $user->first_name = $request->first;
        $user->last_name = $request->last;
        $user->email = $request->email;
        $user->hp = $request->no;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->attachRole('staff');

        return redirect()->route('staff.index')->with(['success' => 'Staff Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if(!$user->hasRole('staff')) {
            return redirect()->route('staff.index')->with(['warning' => 'Staff Not Found!']);
        }

        return view('admin.staff.edit', [
            'staff' => $user,
            'locations' => Location::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if($request->password != null){
            $request->validate([
                'first' => 'required|max:255',
                'last' => 'required|max:255',
                'email' => ['required', 'string', 'email:dns', 'max:255'],
                'no' => 'required',
                'password' => ['string', 'min:5', 'confirmed'],
            ]);

            $user->password = Hash::make($request->password);
        }

        $request->validate([
            'first' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => ['required', 'string', 'email:dns', 'max:255'],
            'no' => 'required',
        ]);

        $user->location_id = $request->location;
        $user->first_name = $request->first;
        $user->last_name = $request->last;
        $user->email = $request->email;
        $user->hp = $request->no;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('staff.index')->with(['success' => 'Staff Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('staff.index')->with(['success' => 'Staff Successfully Deleted']);
    }
}
