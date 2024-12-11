<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function show()
    {
            $books = Book::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('users.home', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $books = Book::where('title', 'like', '%' . $query . '%')
                     ->orWhere('author', 'like', '%' . $query . '%')
                     ->get();
        return response()->json($books);
    }


    public function showBooksByCategory(Request $request)
    {
        $categories = Category::all();
    
        $selectedCategory = $request->input('category');
        
        $booksQuery = Book::query();

        if ($selectedCategory) {
            $booksQuery->where('cate_id', $selectedCategory);
        } else {
            $books = Book::all();
        }

        $books = $booksQuery->paginate(20);
        return view('users.category', compact('categories', 'books', 'selectedCategory'));
    }

    public function showAbout()
    {
        return view('users.about-page');
    }

}
