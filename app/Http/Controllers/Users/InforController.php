<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class InforController extends Controller
{
    public function edit()
    {
            $id = Auth::id();  

            $user = Account::find($id);

            return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $id = Auth::id();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts,email,' . $id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:6|confirmed', 
        ]);


        $user = Account::find($id);

        if ($request->filled('password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if ($request->input('password') !== $request->input('password_confirmation')) {
                return back()->withErrors(['password' => 'The new password and confirmation password do not match.']);
            }

            $user->password = bcrypt($request->input('password'));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $user->save();

        return redirect()->route('users.edit')->with('success', 'Profile updated successfully');
    }
}

