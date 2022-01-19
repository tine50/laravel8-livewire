<?php

use App\Models\Article;
use App\Models\TypeArticle;
use App\Models\ProprieteArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Auth::routes();

// Le groupe des routes relatives aux administrateurs uniquement

Route::group([
    'middleware' => ['auth', 'auth.admin'],
    'as' => 'admin.'
], function(){

    Route::group([
        'prefix' => 'habilitations',
        'as' => 'habilitations.'
    ], function(){

        Route::get('/utilisateurs', [UserController::class, 'index'])->name('users.index');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/habilitations/utilisateurs', [UserController::class, 'index'])->name('utilisateurs')->middleware('auth.admin');

