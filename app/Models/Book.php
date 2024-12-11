<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Đặt tên bảng trong cơ sở dữ liệu nếu không phải bảng số nhiều của model
    protected $table = 'books';

    // Cấu hình các cột có thể được gán giá trị (Mass Assignment)
    protected $fillable = [
        'ISBN',
        'title', 
        'publish_year', 
        'author', 
        'cate_id', 
        'total_copies', 
        'available_copies', 
        'price', 
        'status',  
        'rating',
        'cover_image',
        'rented_count'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }

    public function borrowBooks()
    {
        return $this->hasMany(BorrowBook::class, 'book_id', 'id');
    }

    public function getBorrowedCopiesAttribute()
    {
        return $this->total_copies - $this->available_copies;
    }

    public function scopePopular($query)
    {
        return $query->orderBy('rented_count', 'desc');
    }

    public function scopeNewlyAdded($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
