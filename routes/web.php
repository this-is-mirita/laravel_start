<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\DestroyController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Middleware\AdminPanelMiddleware;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Post\IndexController as AdminPostIndexController;

use App\Http\Controllers\MailController;

Route::get('/contact', [MailController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

Route::get('/', function () {
    return 'asdas';
});

// по конвенции надо давать роуты

// https://laravel.su/docs/12.x/controllers#resursnye-kontrollery


/**
 * Группа маршрутов для постов.
 *
 * - prefix('posts') добавляет префикс /posts ко всем маршрутам внутри группы.
 * - name('post.') добавляет префикс к именам маршрутов (например, post.index, post.store).
 * - Вместо использования namespace в Route::group, контроллеры импортируются через use.
 */

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('posts')->name('post.')->group(function () {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/create', CreateController::class)->name('create');
    Route::post('/', StoreController::class)->name('store');
    Route::get('/{post}', ShowController::class)->name('show');
    Route::get('/{post}/edit', EditController::class)->name('edit');
    Route::patch('/{post}/update', UpdateController::class)->name('update');
    Route::delete('/{post}/delete', DestroyController::class)->name('delete');
});

Route::prefix('admin')->name('admin.')->middleware(AdminPanelMiddleware::class)->group(function () {
    Route::get('/', [AdminPostIndexController::class, 'index'])->name('index');
});


Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


//Route::get('/posts/update', [PostController::class, 'update']);
//Route::get('/posts/delete', [PostController::class, 'delete']);
//Route::get('/posts/firstOrCreate', [PostController::class, 'firstOrCreate']);
//Route::get('/posts/updateOrCreate', [PostController::class, 'updateOrCreate']);
