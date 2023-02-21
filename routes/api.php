<?php

use App\Models\myTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;

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
    // logout if token exist
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth.guard:admin-api');
});

// login user
Route::group(['prefix'=>'user'],function(){

    Route::post('/login',[AuthController::class,'UserLogin']);

});


// user
Route::group(['prefix'=>'user','middleware'=>'auth.guard:user-api'],function(){

    Route::post('/profil',function(){
        return Auth::user(); //return auth of user
    });

});
Route::group(['middleware'=>['api','checkPassword','changeLanguage','checkAdminToken:admin-api']],function(){

Route::get('/offers',[CategoriesController::class,'index']);

});
