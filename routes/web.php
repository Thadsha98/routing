<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Welcome to my laravel app";
});


Route::get('/user/{id}', function ($id) {
    return 'User ID:'.$id;
})->where ('id', '[0-9]+');


Route::get('/profile/{name?}', function ($name ='Guest') {
    return 'welcome:'.$name;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', function () {
        return "Admin Users List";
    });

    Route::get('/settings', function () {
        return "Admin Settings";
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/products/{product}', function (Product $product) {
    return $product->name;
});


Route::redirect('/old-url', '/new-url' );

Route::fallback(function () {
    return "Oops, page not found!";
});
