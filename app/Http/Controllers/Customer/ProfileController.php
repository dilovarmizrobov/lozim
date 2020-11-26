<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('customer.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'address'=>'required|max:255',
            'phone'=>'required|max:255',
        ]);

        Auth::user()->customer->fill($request->all())->save();

        return redirect()->back()->with('success', 'Личные данные были успешно обновлены!');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        $valid_password = Auth::validate([
            'email'=>$user->email,
            'password'=>$request->password
        ]);

        if ($valid_password) $user->update(['password' => Hash::make($request->new_password)]);
        else return redirect()->back()->with('success', 'Текущий пароль не верен!');

        return redirect()->back()->with('success', 'Текущий пароль была успешно обновлена!');
    }
}
