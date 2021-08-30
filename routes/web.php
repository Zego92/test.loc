<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/payment-widget', [App\Http\Livewire\PaymentWidget::class, 'render']);
Route::post('/payment-widget', [App\Http\Livewire\PaymentWidget::class, 'save'])->name('payment.add');
Route::get('/payment-table-widget', [App\Http\Livewire\PaymentTableWidget::class, 'render']);
