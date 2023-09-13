<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
     public function index(){

        $categories = Category::all();
        return response()->json($categories, 200);

     }

     public function store(Request $request)
     {
         $input = $request->all();

         $validator = Validator::make($input, [
             'title' => 'required',

         ]);

         if($validator->fails()){
             return $this->sendError('Validation Error.', $validator->errors());
         }

         $category = Category::create($input);


          return response()->json($category, 200);
     }

     public function update(Request $request ,  $id)
     {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

         $category =  Category::find($id);
         $category->title = $input['title'];
        $category->save();


          return response()->json($category, 200);
     }

     public function destroy($id)
    {
        $category =  Category::find($id);
        $category->delete();
        return response()->json(null ,401);
    }
}
