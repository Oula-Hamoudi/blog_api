<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Page,Comment};
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(){

        $pages = Page::all();
        return response()->json($pages, 200);

     }
     public function store(Request $request)
     {
         $input = $request->all();

         $validator = Validator::make($input, [
             'titel' => 'required',
             'body' => 'required',

         ]);
         if($validator->fails()){
          // return response()->json('Validation Error.', $validator->errors());
         }
         $pages = new Page();
         $pages->title = $input['title'];
         $pages->body = $input['body'];
         $pages->save();

         $comment = new Comment;
         $comment->body = "Hi It is comment for post".  $pages->id;

         $pages->comments()->save($comment);


          return response()->json([
'success'=>true,
            ]
        );
     }
     public function update(Request $request ,  $id)
     {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'nullable',
            'body' => 'nullable',

        ]);
        if($validator->fails()){
            return response()->json('Validation Error.', $validator->errors());
        }

         $pages =  Page::find($id);
         $pages->title = $input['title'];
         $pages->body = $input['body'];
         $pages->save();


          return response()->json($posts, 200);
     }
     public function destroy($id)
     {
        $pages=  Page::find($id);
        $pages->delete();
         return response()->json(null ,401);
     }
}
