<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes pour les articles 

Route::get('/article',  [ArticleController::class,'index']);

Route::post('/article', [ArticleController::class, 'store']);

Route::get('/article/{i}', [ArticleController::class, 'show']);

Route::get('/article/{id}',[ArticleController::class, 'edit']);

Route::put('/article/{id}',[ArticleController::class, 'update']);

Route::delete('/article/{id}', [ArticleController::class, 'destroy']);

// Routes pour les Commentaires

Route::get('/comment', [CommentController::class, 'index']);

Route::post('/comment', [CommentController::class, 'store']);

Route::get('/comment/{id}', [CommentController::class, 'show']);

Route::get('/comment/{id}', [CommentController::class, 'edit']);

Route::put('/comment/{id}', [CommentController::class, 'update']);

Route::delete('/comment/{id}', [CommentController::class, 'destroy']);

//Route pour l'enregistrement

Route::post('/register',[AuthController::class,'register']);

// Route pour se déconnecter

Route::post('/logout',[AuthController::class,'logout']);

// Route pour le Login

Route::post('/login',[AuthController::class,'login']);

// Route pour Supprimer un utilisateur

Route::delete('/user',[UserController::class,'destroy']);