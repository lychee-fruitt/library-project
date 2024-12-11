<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
  
    public function show(Request $request)
    {
            // Bắt đầu query từ model Book với mối quan hệ đã liên kết category
        $booksQuery = Book::with('category');

        // Tìm kiếm theo tên sách (không phân biệt hoa thường)
        if ($request->has('title') && $request->title != '') {
            $booksQuery->where('title', 'like', '%' . strtolower($request->title) . '%');
        }

        // Lọc theo thể loại
        if ($request->has('cate_id') && $request->cate_id != '') {
            $booksQuery->where('cate_id', $request->cate_id);
        }

        // Lọc theo khoảng giá
        $minPrice = $request->get('min_price', null);
        $maxPrice = $request->get('max_price', null);

        if (!is_null($minPrice) && !is_null($maxPrice)) {
            $booksQuery->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (!is_null($minPrice)) {
            $booksQuery->where('price', '>=', $minPrice);
        } elseif (!is_null($maxPrice)) {
            $booksQuery->where('price', '<=', $maxPrice);
        }

        // Thực thi query
        $books = $booksQuery->get();

        // Lấy danh sách tất cả thể loại để hiển thị trong bộ lọc
        $categories = \App\Models\Category::all();

        // Trả về view với dữ liệu sách và danh sách thể loại
        return view('admin.bookmanagement', compact('books', 'categories'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.editbook', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ISBN' => 'required|string|max:13',
            'title' => 'required|string|max:255',
            'publish_year' => 'required|integer|digits:4',
            'author' => 'required|string|max:255',
            'cate_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $book = Book::findOrFail($id);

    // Only delete and upload a new image if the file is provided
    if ($request->hasFile('cover_image')) {
        // Delete the old cover image if it exists
        if ($book->cover_image && \Storage::disk('public')->exists($book->cover_image)) {
            \Storage::disk('public')->delete($book->cover_image);
        }

        // Save the new cover image
        $coverImagePath = $request->file('cover_image')->store('books', 'public');
        $book->cover_image = $coverImagePath;
    }

    // Ensure available copies do not exceed total copies
    if ($request->input('available_copies') > $request->input('total_copies')) {
        return redirect()->back()->withErrors(['available_copies' => 'Available copies cannot exceed total copies.']);
    }

    $book->update($request->except('cover_image'));  

    return redirect()->route('admin.bookmanagement')->with('success', 'Book updated successfully');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.addingbook', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ISBN' => 'required|string|max:13',
            'title' => 'required|string|max:255',
            'publish_year' => 'required|integer|digits:4',
            'author' => 'required|string|max:255',
            'cate_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $coverImagePath = $request->file('cover_image')->store('books', 'public');

            if ($request->input('available_copies') > $request->input('total_copies')) {
                return redirect()->back()->withErrors(['available_copies' => 'Available copies cannot exceed total copies.']);
            }
    
            $book = Book::create([
                'ISBN' => $request->input('ISBN'),
                'title' => $request->input('title'),
                'publish_year' => $request->input('publish_year'),
                'author' => $request->input('author'),
                'cate_id' => $request->input('cate_id'),
                'total_copies' => $request->input('total_copies'),
                'available_copies' => $request->input('available_copies') ?? $request->input('total_copies'),
                'price' => $request->input('price'),
                'status' => $request->input('status'),
                'cover_image' => $coverImagePath,
            ]);
    
            if ($book) {
                return redirect()->route('admin.bookmanagement')->with('success', 'Book added successfully.');
            } else {

                return redirect()->back()->with('error', 'Failed to create a new book. Please try again.');
            }
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'An error occurred while creating the book: ' . $e->getMessage());
        }    
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Optional: Check if available copies are greater than 0
        if ($book->available_copies < $book->total_copies) {
            return redirect()->route('admin.bookmanagement')->withErrors(['delete_error' => 'Cannot delete because this book is having borrowed copy.']);
        }

        $book->delete();
        return redirect()->route('admin.bookmanagement')->with('success', 'Book deleted successfully.');
    }
    
 

    
}