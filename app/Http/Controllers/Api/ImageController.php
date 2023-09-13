<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
class ImageController extends Controller
{
    public function index(){

        $images = Image::all();
        return response()->json($images, 200);

     }
     public function store(Request $request)
     {
         $input = $request->all();

         $validator = Validator::make($input, [
             'image_name' => 'required',

         ]);
         if($validator->fails()){
             return $this->sendError('Validation Error.', $validator->errors());
         }
         $images = new Image();
         $images->image = $input['image_name'];
         $images->post_id = 1;
         $images->save();
          return response()->json($images, 200);
     }

     public function update(Request $request ,  $id)
     {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image_name' => 'nullable',

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

         $images =  Image::find($id);
         $images->image = $input['image_name'];
        $images->save();


          return response()->json($images, 200);
     }
     public function destroy($id)
     {
        $images=  Image::find($id);
        $images->delete();
         return response()->json(null ,401);
     }
}
