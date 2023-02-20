<?php

use App\Models\myTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AuthController;

// Route::post('/myPage',function(){

//     return myTable::create([
//          'title'=>'laravel intro',
//          'description'=>'laravel is a framework for php'
//     ]);
// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// All route/Api here must be api authenticated

Route::group(['middleware'=>['api','checkPassword','changeLanguage']],function(){

    Route::post('/get-main-categories',[CategoriesController::class,'index']);
    Route::post('/get-categorie-by-id',[CategoriesController::class,'getCategoryById']);
    Route::post('/change-category-status',[CategoriesController::class,'changeCategoryStatus']);

});

Route::group(['prefix'=>'admin'],function(){
    Route::post('/login',[AuthController::class,'login']);

});

Route::group(['middleware'=>['api','checkPassword','changeLanguage','checkAdminToken:admin-api']],function(){

Route::get('/offers',[CategoriesController::class,'index']);

});

