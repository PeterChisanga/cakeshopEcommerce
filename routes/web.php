<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailContoller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    Session::forget('adminUser');
    return redirect('/');
});

Route::get("/",[ProductController::class,'index']);
Route::view("/register",'register');
Route::post("/login",[UserController::class,'login']);
Route::post("/register",[UserController::class,'register']);
Route::get('password/reset', [UserController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [UserController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{reset_code}', [UserController::class,'showResetForm'])->name('password.reset');
Route::post('/password/reset/{reset_code}', [UserController::class,'reset'])->name('password.update');
Route::get("detail/{id}",[ProductController::class,'detail']);
Route::get("search",[ProductController::class,'search']);
Route::post("add_to_cart",[ProductController::class,'addToCart']);
Route::get("cartlist",[ProductController::class,'cartList']);
Route::get("ordernow",[ProductController::class,'orderNow']);
Route::get("removecart/{cart_id}",[ProductController::class,'removeCart']);
Route::post("orderplace",[ProductController::class,'orderPlace']);
Route::get("myorders",[ProductController::class,'myOrders']);

// ------------Administration------------
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post("/admin/send",[MailContoller::class,'index']);
Route::view("/admin/create-account",'admin/register');
Route::post('/admin/create-account', [AdminController::class, 'createAccount'])->name('admin.create_account');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/orders', [AdminController::class, 'viewOrders'])->name('admin.orders');
Route::get('/admin/orders/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.delete_order');
Route::get('/admin/customers', [AdminController::class, 'viewCustomers'])->name('admin.customers');
Route::get('/admin/products', [AdminController::class, 'viewProducts'])->name('admin.products');
Route::get('/admin/products/add', [AdminController::class, 'addProduct'])->name('admin.add_product');
Route::post('/admin/products/add', [AdminController::class, 'addProduct'])->name('admin.add_product.submit');
Route::get('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.delete_product');
Route::get('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.update_product');
Route::post('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.update_product.submit');

