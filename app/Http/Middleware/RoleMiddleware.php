<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Kiểm tra nếu user không đăng nhập hoặc không có quyền
        if (!$user || $user->role_id != $role) {
            return redirect('/unauthorized'); // Điều hướng đến trang báo lỗi
        }

        return $next($request);
    }
}
