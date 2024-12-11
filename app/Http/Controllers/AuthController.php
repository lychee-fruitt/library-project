<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
    
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role_id == 2) {
                return redirect()->route('user.user-dashboard'); 
            }
        }
    
        return back()->withErrors(['username' => 'Thông tin đăng nhập không đúng']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); // Hủy session
        $request->session()->regenerateToken(); 
        return redirect()->route('login.form');;
    }


       public function showRegisterForm()
       {
           return view('auth.register');
       }
   
       public function register(Request $request)
       {
           $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:accounts,username',
            'email' => 'required|string|email|max:255|unique:accounts,email', 
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $account = new Account();
        $account->name = $request->name;
        $account->username = $request->username;
        $account->email = $request->email;
        $account->phone = $request->phone;
        $account->password = Hash::make($request->password);
        $account->role_id = 2; 
        $account->save();

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');

    }
}
