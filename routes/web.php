<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/notify',[App\Http\Controllers\HomeController::class,'notify']);
Auth::routes();
Route::prefix('/')->group(function(){
   
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/list-acc-nomal', [App\Http\Controllers\HomeController::class, 'list_nomal'])->name('list.nomal');
    Route::get('/list-acc-vip', [App\Http\Controllers\HomeController::class, 'list_accVip'])->name('list.vip');
    // Route::get('/list-acc-vip', [App\Http\Controllers\UserController::class, 'search_accVip'])->name('search.vip');
    Route::get('/list-acc-vip/detail/{id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
    Route::get('/add-to-cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
    Route::delete('/delete-cart/{id}', [App\Http\Controllers\HomeController::class, 'deleteCart'])->name('deleteCart');


    Route::post('add-to-cart', [App\Http\Controllers\HomeController::class, 'post_cart'])->name('postcart');
    Route::post('buy-carts', [App\Http\Controllers\HomeController::class, 'buy_post_cart'])->name('buypostcart');

    Route::post('buy-cart', [App\Http\Controllers\HomeController::class, 'buy_cart'])->name('buyCart');

    Route::get('/add-card', [App\Http\Controllers\HomeController::class, 'add_card'])->name('add_card');
    Route::post('/post-card', [App\Http\Controllers\HomeController::class, 'post_card'])->name('post_card');
    Route::get('/buy-history', [App\Http\Controllers\HomeController::class, 'buy_history'])->name('buy_history');
    Route::get('/callback',[UserController::class, 'callback'])->name('callback');


});
// Route::post('')
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    //hero
    Route::get('/list-products', [App\Http\Controllers\AdminController::class, 'list_products'])->name('list.products');
    Route::get('/edit-product/{id}', [App\Http\Controllers\AdminController::class, 'edit_products'])->name('edit.list');
    Route::post('/edit-product', [App\Http\Controllers\ListAdmin::class, 'edit_products'])->name('postEdit.list');
    Route::get('/add-products', [App\Http\Controllers\AdminController::class, 'add_products'])->name('add.products');
    Route::post('/add-products', [App\Http\Controllers\ListAdmin::class, 'add_products'])->name('post.products');
    Route::delete('/remove-product/{id}', [App\Http\Controllers\ListAdmin::class, 'remove_products'])->name('remove.list');
    //End hero

    //weapon
    Route::get('/list-weapon', [App\Http\Controllers\AdminController::class, 'list_weapon'])->name('list.weapon');
    Route::get('/add-weapon', [App\Http\Controllers\AdminController::class, 'add_weapon'])->name('add.weapon');
    Route::post('/add-weapon', [App\Http\Controllers\ListAdmin::class, 'add_weapon'])->name('post.weapon');
    Route::get('/edit-weapon/{id}', [App\Http\Controllers\AdminController::class, 'edit_weapons'])->name('editWeapon.list');
    Route::post('/edit-weapon', [App\Http\Controllers\ListAdmin::class, 'edit_weapons'])->name('edit.weapon');
    Route::delete('/remove-weapon/{id}', [App\Http\Controllers\ListAdmin::class, 'remove_weapons'])->name('remove.weapon');
    //End weapon
    Route::get('/list-account', [App\Http\Controllers\AdminController::class, 'list_account'])->name('list.account');
    Route::get('/add-account', [App\Http\Controllers\AdminController::class, 'add_account'])->name('add.account');
    Route::post('/add-account', [App\Http\Controllers\ListAdmin::class, 'post_account'])->name('post.account');
    Route::get('/edit-account/{id}', [App\Http\Controllers\AdminController::class, 'edit_account'])->name('edit.account');
    Route::post('/edit-account', [App\Http\Controllers\ListAdmin::class, 'edit_account'])->name('editPost.account');
    Route::delete('/remove-account/{id}', [App\Http\Controllers\ListAdmin::class, 'remove_account'])->name('remove.account');
});

Route::middleware(['auth','user'])->prefix('/')->group(function(){

});
