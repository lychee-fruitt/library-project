<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable // Kế thừa từ Authenticatable
{
    use HasFactory, Notifiable; // Sử dụng Notifiable để gửi thông báo

    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Định nghĩa mối quan hệ với role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Bạn có thể không cần phải viết lại các phương thức này vì chúng đã có trong Authenticatable
    // Nhưng nếu muốn, bạn có thể làm như sau:

    // Để Laravel xác định khóa chính của người dùng
    public function getAuthIdentifierName()
    {
        return 'id'; // Trả về trường 'id' làm khóa chính
    }

    // Trả về giá trị khóa chính của người dùng
    public function getAuthIdentifier()
    {
        return $this->getKey(); // Trả về ID của người dùng
    }

    // Trả về mật khẩu của người dùng
    public function getAuthPassword()
    {
        return $this->password; // Trả về mật khẩu của người dùng
    }
}

