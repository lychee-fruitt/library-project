<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\BorrowBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BorrowController extends Controller
{   

    public function returnBook(Request $request, $id)
    {
        $borrowBook = BorrowBook::find($id);

        if (!$borrowBook) {
            return redirect()->back()->with('error', 'Borrow request not found.');
        }
    
        if ($borrowBook->status !== 'approved') {
            return redirect()->back()->with('error', 'Only approved borrow requests can be returned.');
        }
    
        
        $book = Book::find($borrowBook->book_id);
        if ($book) {
            $book->available_copies += $borrowBook->quantity; 
            $book->save();
        }
    
      
        $borrowBook->status = 'returned';
        $borrowBook->save();
    
        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    public function viewBorrowRequests(Request $request)
    {
       
        $borrowBooksQuery = BorrowBook::with(['book', 'member']); 
    

        if ($request->has('book_title')) {
            $borrowBooksQuery->whereHas('book', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->book_title . '%');
            });
        }
    
        if ($request->has('member_name')) {
            $borrowBooksQuery->whereHas('member', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->member_name . '%');
            });
        }
    
        if ($request->has('borrow_date')) {
            $borrowBooksQuery->where('borrow_date', '>=', $request->borrow_date);
        }
    
        if ($request->has('return_date')) {
            $borrowBooksQuery->where('return_date', '<=', $request->return_date);
        }
    

        $borrowBooks = $borrowBooksQuery->get();
    
    
        return view('admin.borrowed-list', compact('borrowBooks'));
    }
    
    public function approve($id)
    {
        $borrowBook = BorrowBook::findOrFail($id);
        if ($borrowBook->status === 'pending') {
            $borrowBook->status = 'approved';
            $borrowBook->save();
        }
        return redirect()->route('admin.borrow_requests')->with('success', 'Borrow request approved.');
    }

    public function reject($id)
    {
        $borrowBook = BorrowBook::findOrFail($id);
        if ($borrowBook->status === 'pending') {
            $borrowBook->status = 'rejected';
            $borrowBook->save();
        }

        $book = Book::find($borrowBook->book_id);
        if ($book) {
            $book->available_copies += $borrowBook->quantity;
            $book->save();
        }
        return redirect()->route('admin.borrow_requests')->with('success', 'Borrow request rejected.');
    }
    
}