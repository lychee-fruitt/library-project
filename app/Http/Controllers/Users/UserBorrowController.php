<?php

namespace App\Http\Controllers\Users;

use App\Models\Book;
use App\Models\BorrowBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserBorrowController extends Controller
{
    public function showBorrowList()
    {
        $borrowBooks = BorrowBook::where('member_id', auth()->id())
        ->whereNull('borrow_date')
        ->where('status', 'pending') 
        ->get();

         return view('users.borrow_list', compact('borrowBooks'));
    }

    public function addToBorrowList(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
    
        $bookId = $request->book_id;
        $accountId = Auth::id();
    
        $borrowList = BorrowBook::where('book_id', $bookId)
            ->where('member_id', $accountId)
            ->whereIn('status', ['pending', 'approved']) 
            ->first();
    
        if ($borrowList) {
            $borrowList->quantity += $request->quantity; 
            $borrowList->save();
        } else {

            BorrowBook::create([
                'book_id' => $bookId,
                'quantity' => $request->quantity,
                'member_id' => $accountId, 
                'status' => 'pending', 
            ]);
        }
    
        return redirect()->route('users.borrow_list')->with('success', 'Book has been added.');
    }
    public function removeFromBorrowList($id)
    {
        $borrowList = BorrowBook::where('id', $id)
            ->where('member_id', Auth::id())
            ->firstOrFail();
        $borrowList->delete();

        return redirect()->route('users.borrow_list')->with('success', 'Book has been deleted.');
    }

    public function registerBorrow(Request $request)
    {
            $request->validate([
                'borrow_date' => 'required|date', 
                'return_date' => 'required|date|after:borrow_date',
            ]);

            $borrowDate = $request->input('borrow_date');
            $returnDate = $request->input('return_date');


            $borrowBooks = BorrowBook::where('member_id', auth()->id())
                                    ->where('status', 'pending')
                                    ->get();

            foreach ($borrowBooks as $borrowBook) {
                $book = Book::findOrFail($borrowBook->book_id);

                if ($book->available_copies >= $borrowBook->quantity) {
                    $borrowBook->borrow_date = $borrowDate;
                    $borrowBook->return_date = $returnDate;
                    $borrowBook->status = 'pending';  
                    $borrowBook->save();

                    $book->available_copies -= $borrowBook->quantity;
                    $book->save();
                } else {
                    return redirect()->back()->withErrors(['error' => 'Not enough availble copies.']);
                }
            }
        return redirect()->route('users.borrow_list')->with('success', 'Books successfully registered for borrowing, awaiting approval.');
    }

    public function memberLibrary(Request $request)
    {
        $accountId = Auth::id();

        $filters = $request->only(['book_title', 'status', 'borrow_date']);
    
        // Query danh sách Borrow Books theo bộ lọc
        $borrowBooks = BorrowBook::with('book')
            ->where('member_id', $accountId)
            ->when($filters['book_title'] ?? null, function ($query, $bookTitle) {
                $query->whereHas('book', function ($q) use ($bookTitle) {
                    $q->where('title', 'like', "%$bookTitle%");
                });
            })
            ->when($filters['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($filters['borrow_date'] ?? null, function ($query, $borrowDate) {
                $query->whereDate('borrow_date', $borrowDate);
            })
            ->orderBy('borrow_date', 'desc')
            ->paginate(10);
    
        return view('users.member_library', compact('borrowBooks'));
    }
}
