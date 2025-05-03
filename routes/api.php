<?php
//
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\Post\CreateController;
//use App\Http\Controllers\Post\DestroyController;
//use App\Http\Controllers\Post\EditController;
//use App\Http\Controllers\Post\IndexController;
//use App\Http\Controllers\Post\ShowController;
//use App\Http\Controllers\Post\StoreController;
//use App\Http\Controllers\Post\UpdateController;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
//Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'api', 'prefix' => 'auth'],
//    function ($router) {
//        Route::post('login', [AuthController::class, 'login']);
//        Route::post('logout', [AuthController::class, 'logout']);
//        Route::post('refresh', [AuthController::class, 'refresh']);
//        Route::post('me', [AuthController::class, 'me']);
//    });
//
//
//Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
//    Route::get('/posts', 'IndexController')->middleware('jwt.auth');
//});
//Route::prefix('posts')->name('post.')->group(function () {
//    Route::get('/', IndexController::class)->name('index');
//    Route::get('/create', CreateController::class)->name('create');
//    Route::post('/', StoreController::class)->name('store');
//    Route::get('/{post}', ShowController::class)->name('show');
//    Route::get('/{post}/', EditController::class)->name('edit');
//    Route::patch('/{post}/', UpdateController::class)->name('update');
//    Route::delete('/{post}/', DestroyController::class)->name('delete');
//});
