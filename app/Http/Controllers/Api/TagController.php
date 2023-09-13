<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index(){

        $tags = Tag::all();
        return response()->json($tags, 200);

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
         $tags = new Tag();
         $tags->tag = $input['image_name'];
         $tags->post_id = 1;
         $tags->save();
          return response()->json($tags, 200);
     }

     public function update(Request $request ,  $id)
     {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'nullable',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

         $tags =  Tag::find($id);
         $tags->tag = $input['title'];
         $tags->save();


          return response()->json($tags, 200);
     }
     public function destroy($id)
     {
        $tags=  Tag::find($id);
        $tags->delete();
         return response()->json(null ,401);
     }
}
