<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Nếu bảng trong database là `role`

    protected $fillable = ['role_name'];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'role_id');
    }
}

