<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StripeWebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ItemController::class, 'index'])->name('products.index');
Route::get('/products',[ItemController::class, 'index'] );

Route::middleware('auth')->group(function () {

    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');

    Route::get('/mypage/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/mypage/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/purchase/address/{item_id}', [UserController::class, 'editAddress'])->name('address.edit');
    Route::post('/purchase/address/{item_id}',[UserController::class, 'updateAddress'])->name('address.update');
});

Route::get('/item/{item}', [ItemController::class, 'detail'])->name('item.detail');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::post('/favorite', [FavoriteController::class, 'favorite'])
    ->middleware('auth')
    ->name('item.favorite');

Route::get('/sell', [ItemController::class, 'sell'])->middleware('auth')->name('sell.form');
Route::post('/sell', [ItemController::class, 'store'])->middleware('auth')->name('sell.store');

Route::middleware('auth')->group(function () {
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase.index');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::post('/purchase/{item_id}/checkout-session', [PurchaseController::class, 'session'])->name('checkout.session');
    Route::get('/purchase/address/{item_id}', [UserController::class, 'editAddress'])->name('address.edit');
    Route::post('/purchase/address/{item_id}', [UserController::class, 'updateAddress'])->name('address.update');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);

Route::get('checkout/success/{item_id}', [PurchaseController::class, 'success'])->name('checkout.success');

Route::get('checkout/cancel/{item_id}', [PurchaseController::class, 'cancel'])->name('checkout.cancel');

Route::get('/search', [ItemController::class, 'search'])->name('items.search');

Route::get('/email/verify', function () {
    return view('certification');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('profile.edit')->with('status', 'verified');
})->middleware(['signed', 'auth'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $user = Auth::user();

    if ($user && !$user->hasVerifiedEmail()) {
        $user->sendEmailVerificationNotification();
    }

    return redirect('http://localhost:8025');
})->middleware('auth','throttle:6,1')->name('verification.send');



