<?php

namespace App\Http\Controllers;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
    // use GeneralTrait;
   public function index(){

     $categories = Category::select()->get();

     return response()->json($categories);
   }
   public function getCategoryById(Request $request){

    $category = Category::find($request->id);
    return response()->json($category);
   }
}
