<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController ;
use App\Http\Controllers\CategoryController ;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//logout
Route::controller(AdminController::class)->group(function(){
    Route::get('admin/logout','destroy')->name('admin.logout');
});

//category Routes
Route::controller(CategoryController::class)->group(function(){
    Route::get('/dashboard','getCategories')->name('admin.categories')->middleware(['auth', 'verified']);
    Route::post('add/category','addCategory')->name('add.category')->middleware(['auth', 'verified']);
    Route::get('/edit/category/{id}','editCategory')->name('edit.category')->middleware(['auth', 'verified']);
    Route::post('/update/category','updateCategory')->name('update.category')->middleware(['auth', 'verified']);
    Route::get('/delete/category/{id}','deleteCategory')->name('delete.category')->middleware(['auth', 'verified']);
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/get/products','getProducts')->name('admin.products')->middleware(['auth', 'verified']);
    Route::post('/add/product','addproduct')->name('add.product')->middleware(['auth', 'verified']);
    Route::get('/edit/product/{id}','editProduct')->name('edit.product')->middleware(['auth', 'verified']);
    Route::post('/update/product','updateProduct')->name('update.product')->middleware(['auth', 'verified']);
    Route::get('/delete/product/{id}','deleteProduct')->name('delete.product')->middleware(['auth', 'verified']);
});

// Route::get('/dashboard', function () {
//     return view('admin.categories');
// })

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
