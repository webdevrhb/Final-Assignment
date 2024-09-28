<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Frontend\PageController::class, 'home'])->name('home');
Route::get('/about', [App\Http\Controllers\Frontend\PageController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\Frontend\PageController::class, 'contact'])->name('contact');


Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginUser']);

Route::get('/register', [App\Http\Controllers\AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerUser']);

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logoutUser'])->name('logout');




Route::resource('/cars', App\Http\Controllers\Frontend\CarController::class)->only(['index', 'show'])->names([
    'index' => 'frontend.cars.index',
    'show' => 'frontend.cars.show',
]);

Route::resource('/rentals', App\Http\Controllers\Frontend\RentalController::class)->names([
    'index' => 'frontend.rentals.index',
    'create' => 'frontend.rentals.create',
    'store' => 'frontend.rentals.store',
    'show' => 'frontend.rentals.show',
    'edit' => 'frontend.rentals.edit',
    'update' => 'frontend.rentals.update',
    'destroy' => 'frontend.rentals.destroy',
])->middleware('auth');

Route::middleware(['auth', 'VerifyRole'])->group(function () {

    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('admin/cars', App\Http\Controllers\Admin\CarController::class)->names([
        'index' => 'admin.cars.index',
        'create' => 'admin.cars.create',
        'store' => 'admin.cars.store',
        'show' => 'admin.cars.show',
        'edit' => 'admin.cars.edit',
        'update' => 'admin.cars.update',
        'destroy' => 'admin.cars.destroy',
    ]);

    Route::resource('admin/rentals', App\Http\Controllers\Admin\RentalController::class)->names([
        'index' => 'admin.rentals.index',
        'create' => 'admin.rentals.create',
        'store' => 'admin.rentals.store',
        'show' => 'admin.rentals.show',
        'edit' => 'admin.rentals.edit',
        'update' => 'admin.rentals.update',
        'destroy' => 'admin.rentals.destroy',
    ]);

    Route::resource('admin/customers', App\Http\Controllers\Admin\CustomerController::class)->names([
        'index' => 'admin.customers.index',
        'create' => 'admin.customers.create',
        'store' => 'admin.customers.store',
        'show' => 'admin.customers.show',
        'edit' => 'admin.customers.edit',
        'update' => 'admin.customers.update',
        'destroy' => 'admin.customers.destroy',
    ]);
});