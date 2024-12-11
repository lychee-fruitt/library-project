<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Users\UserDashboardController;
use App\Http\Controllers\Users\UserBookController;
use App\Http\Controllers\Users\UserBorrowController;
use App\Http\Controllers\Users\InforController;


// Auth Route
Route::get('/', [AuthController::class, 'loginForm'])->name('login.form');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');  
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('admin.dashboard');

    // Book routes
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'show'])->name('admin.bookmanagement');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('admin.books.delete');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/{id}', [BookController::class, 'update'])->name('admin.books.update');
        Route::get('/add', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/add', [BookController::class, 'store'])->name('admin.books.store');
    });

    // User routes
    Route::prefix('members')->group(function () {
        Route::get('/', [UserController::class, 'showUser'])->name('admin.listmember.show');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    });

    Route::get('/borrow-list', [BorrowController::class, 'viewBorrowRequests'])->name('admin.borrow_requests');
    Route::patch('/borrow-list/{id}/approve', [BorrowController::class, 'approve'])->name('admin.borrow.approve');
    Route::patch('/borrow-list/{id}/reject', [BorrowController::class, 'reject'])->name('admin.borrow.reject');
    Route::get('/borrow-list/{id}/edit', [BorrowController::class, 'edit'])->name('admin.borrow.edit');
    Route::patch('/borrow-list/{id}/return', [BorrowController::class, 'returnBook'])->name('admin.borrow.return');


    // Category routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'show'])->name('admin.categorymanagement');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/add', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/add', [CategoryController::class, 'store'])->name('admin.categories.store');
    });
});

// Member Route
Route::prefix('member')->middleware('auth')->group(function () {
    Route::get('/home', [UserDashboardController::class, 'show'])->name('user.user-dashboard');
    Route::get('/books-by-category', [UserDashboardController::class, 'showBooksByCategory'])->name('user.category');
    Route::get('/book/{id}', [UserBookController::class, 'show'])->name('user.book');
    Route::get('/borrow-list', [UserBorrowController::class, 'showBorrowList'])->name('users.borrow_list');
    Route::post('/borrow-list/add', [UserBorrowController::class, 'addToBorrowList'])->name('users.add_to_borrow_list');
    Route::delete('/borrow-list/remove/{id}', [UserBorrowController::class, 'removeFromBorrowList'])->name('users.remove_from_borrow_list');
    Route::delete('/borrow-list/clear', [UserBorrowController::class, 'clearBorrowList'])->name('users.clear_borrow_list');
    Route::post('/borrow-list/register', [UserBorrowController::class, 'registerBorrow'])->name('users.register_borrow');   
    Route::get('/my-library', [UserBorrowController::class, 'memberLibrary'])->name('users.member_library');  
    Route::get('/edit', [InforController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [InforController::class, 'update'])->name('users.update');
    Route::get('/search', [UserDashboardController::class, 'search'])->name('books.search');
    Route::get('/about-us', [UserDashboardController::class, 'showAbout'])->name('users.about');
});
