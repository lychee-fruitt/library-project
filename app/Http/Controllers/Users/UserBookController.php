<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class UserBookController extends Controller
{   
    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('users.book', compact('book'));
    }

    
}
