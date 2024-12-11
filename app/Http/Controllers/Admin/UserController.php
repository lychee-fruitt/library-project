<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Role;


class UserController extends Controller
{
    public function showUser()
    {
        // Lấy danh sách người dùng
        $accounts = Account::with('role')->get(); // Giả sử bạn đã định nghĩa quan hệ role trong model User

        // Trả về view với dữ liệu người dùng
        return view('admin.userlist', compact('accounts'));
    }

    public function create()
    {
        $roles = Role::all(); // Lấy danh sách role để hiển thị trong form
        return view('admin.createmember', compact('roles'));
    }

    public function edit($id)
    {
        $user = Account::findOrFail($id); // Tìm tài khoản theo ID
        $roles = Role::all(); // Lấy danh sách roles
        return view('admin.editmember', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'phone' => 'required|unique:accounts,phone',
            'password' => 'required|min:6',
            'username' => 'required|unique:accounts,username|max:50', 
     ]);

        Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'username' => $request->username, 
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.listmember.show')->with('success', 'Account created successfully!');
    }

    public function update(Request $request, $id)
{
    $user = Account::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:accounts,username,' . $id,
            'email' => 'required|email|unique:accounts,email,' . $id,
            'phone' => 'required|numeric|unique:accounts,phone,' . $id,
            'role_id' => 'required|exists:role,id',
            'password' => 'nullable|string|min:6',
      ]);

     $user->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'role_id' => $request->role_id,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
    ]);

        return redirect()->route('admin.listmember.show')->with('success', 'Account updated successfully!');
    }

    public function destroy($id)
    {
        $user = Account::findOrFail($id); 

        if ($user->role_id == 1) { 
            return redirect()->route('admin.users.edit')->with('error', 'You cannot delete an admin account!');
    }

        $user->delete(); // Xóa tài khoản

        return redirect()->route('admin.listmember.show')->with('success', 'Account deleted successfully!');
    }

}
