<?php

namespace App\Http\Controllers;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
    use GeneralTrait;
   public function index(){

     $categories = Category::select()->get();

     return response()->json($categories);
   }
   public function getCategoryById(Request $request){

    $category = Category::find($request->id);

    if(!$category){

       return  $this->returnError('001','this category not found!');
    }
    return $this->returnData('category',$category,'success request');
    // return response()->json($category);
   }
}
