<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [ContactController::class, 'index'])->name('contact.index');

// 確認ページ
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

// お問い合わせフォーム（送信後）
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// サンクスページ
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 管理画面（ログイン後に表示）
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');

// 管理画面（ログイン後にエクスポート）
Route::get('/admin/export', [AdminController::class, 'export'])->middleware(['auth'])->name('admin.export');

// 管理画面（ログイン後に表示）
Route::get('/admin/{id}', [AdminController::class, 'show'])->middleware(['auth'])->name('admin.show');

// 管理画面（データ削除）
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

// ユーザー登録ページ
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ユーザー登録処理
Route::post('/register', [CustomRegisterController::class, 'register'])->name('register');

// ログインページ
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('login', [LoginController::class, 'login']);
