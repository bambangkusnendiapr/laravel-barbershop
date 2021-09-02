<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request, $id)
    {
        if($request->password) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }

        $user = User::find($id);
        $user->first_name = $request->first;
        $user->last_name = $request->last;
        $user->email = $request->email;
        $user->hp = $request->hp;
        $user->address = $request->address;

        if($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with(['success' => 'Data Successfully Updated']);
    }
}
