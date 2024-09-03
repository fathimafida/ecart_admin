<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/profile', [AuthController::class,'profile']);



// Product
Route::get('/products',[ProductController::class,'index']);
Route::post('/add-product',[ProductController::class,'addProduct']);
Route::post('/edit-product/{id}',[ProductController::class,'editProduct']);

// category
// Route::get('/category',[CategoryController::class,'index']);
// Route::post('/category',[CategoryController::class,'store']);
// Route::delete('/category/{category}',[CategoryController::class,'destroy']);
// Route::get('/category/{category}',[CategoryController::class,'show']);
// Route::put('/category/{category}',[CategoryController::class,'update']);

Route::apiResource('/categories',CategoryController::class);

// Tags
Route::get('/tags',[TagController::class,'getAllTags']);
Route::get('/tag/{id}',[TagController::class,'getTagDetails']);
Route::post('/tag',[TagController::class,'createTag']);
Route::put('/tag/{id}',[TagController::class,'updateTag']);
Route::delete('/tag/{id}',[TagController::class,'deleteTag']);


});

