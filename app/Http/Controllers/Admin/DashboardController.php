<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\BorrowBook;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $totalCategories = Category::count();
        $totalBooks = Book::count();
        $totalBorrowedBooks = Book::sum('total_copies') - Book::sum('available_copies');

        $dateRange = $request->input('date_range', 'last_week'); 
        $data = $this->getDataForChart($dateRange);

        return view('admin.dashboard', compact('totalCategories', 'totalBooks', 'totalBorrowedBooks','data'));
        return view('users.user-dashboard');
    }

    private function getDataForChart($dateRange)
    {
        $labels = []; 
        $values = []; 

        $borrowedBooks = BorrowBook::where('borrow_date', '>=', now()->subDays(7))->get();
        foreach ($borrowedBooks as $record) {
            
            $date = \Carbon\Carbon::parse($record->borrow_date)->format('Y-m-d');
            if (!array_key_exists($date, $values)) {
                $values[$date] = 0;
                $labels[] = $date;
            }
            $values[$date]++;
        }
        
        return [
            'labels' => $labels,
            'data' => array_values($values),
        ];
        
    }
}
