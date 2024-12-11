<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    use HasFactory;

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    // Đặt tên bảng nếu nó khác với tên mặc định
    protected $table = 'borrow_books';

    // Nếu bạn không muốn Laravel tự động quản lý các cột thời gian (created_at, updated_at)
    public $timestamps = false;

    // Các cột có thể được gán đại diện (mass assignable)
    protected $fillable = [
        'book_id', 'member_id', 'borrow_date', 'return_date', 'is_returned', 'is_overdue','quantity','status',
    ];

    // Định nghĩa quan hệ với bảng Books
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // Định nghĩa quan hệ với bảng Users (members)
    public function member()
    {
        return $this->belongsTo(Account::class, 'member_id','id');
    }
}
