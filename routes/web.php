<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userManagement;
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
    return view('auth.login');
})->middleware('guest');
Route::get('/importCategory', function () {
    return view('admin.importCategory');
})->middleware(['auth', 'verified']);
//logout
Route::controller(AdminController::class)->group(function () {
    Route::get('admin/logout', 'destroy')->name('admin.logout');
});

Route::controller(userManagement::class)->group(function () {
    Route::get('/userManagement', 'list')->name('admin.list')->middleware(['auth', 'verified']);
    Route::get('/admin/table', 'get')->name('admin.table')->middleware(['auth', 'verified']);
    Route::post('/user/delete', 'deleteUser')->name('user.delete')->middleware(['auth', 'verified']);
    Route::post('/user/update', 'updateUser')->name('user.update')->middleware(['auth', 'verified']);
});

//category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/dashboard', 'getCategories')->name('admin.categories')->middleware(['auth', 'verified']);
    Route::post('/add/category', 'addCategory')->name('add.category')->middleware(['auth', 'verified']);
    Route::post('/edit/category', 'editCategory')->name('edit.category')->middleware(['auth', 'verified']);
    Route::post('/update/category', 'updateCategory')->name('update.category')->middleware(['auth', 'verified']);
    Route::post('/delete/category', 'deleteCategory')->name('delete.category')->middleware(['auth', 'verified']);
    Route::get('/categories', 'getCategoriesForOption')->name('get.categories')->middleware(['auth', 'verified']);
    Route::post('/get/categories', 'getAllCategories')->name('get.All.categories')->middleware(['auth', 'verified']);
    Route::post('/import/categories', 'importCsv')->name('import.categories')->middleware(['auth', 'verified']);
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'getProducts')->name('admin.products')->middleware(['auth', 'verified']);
    Route::post('/add/product', 'addproduct')->name('add.product')->middleware(['auth', 'verified']);
    Route::post('/edit/product', 'editProduct')->name('edit.product')->middleware(['auth', 'verified']);
    Route::post('/update/product', 'updateProduct')->name('update.product')->middleware(['auth', 'verified']);
    Route::post('/delete/product', 'deleteProduct')->name('delete.product')->middleware(['auth', 'verified']);
    Route::post('/get/productByCategory', 'getProductsByCategory')->name('cat.product')->middleware(['auth', 'verified']);
    Route::get('/product-export', 'export')->name('products.export')->middleware(['auth', 'verified']);
});


// frontend

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('frontend.home');
});

// Route::get('/dashboard', function () {
//     return view('admin.categories');
// })

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
