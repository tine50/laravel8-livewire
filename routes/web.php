<?php

use App\Models\Article;
use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
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

Route::get('/articles', function () {
    return Article::with('type_article')->paginate(5);
});

Route::get('/types', function () {
    return TypeArticle::with('articles', 'propriete_articles')->paginate(5);
});

Route::get('/propriete', function () {
    return ProprieteArticle::with('type_article')->paginate(5);
});
