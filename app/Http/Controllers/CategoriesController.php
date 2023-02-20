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

    //  return response()->json($categories);
    return $this->returnData('categories',$categories,'success');
   }
   public function getCategoryById(Request $request){

    $category = Category::find($request->id);

    if(!$category){

       return  $this->returnError('001','this category not found!');
    }
    return $this->returnData('category',$category,'success request');
    // return response()->json($category);
   }

   public function changeCategoryStatus(Request $request){



    $category=Category::where('id',$request->id)->update(['active'=>$request->active]);
    if(!$category){
    return $this->returnError(400,'Update not success');

    }

    return $this->returnSuccessMessage('update successfully!');

   }
}
