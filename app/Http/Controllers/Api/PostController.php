<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Post,Comment};
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        return response()->json($posts, 200);

     }
     public function store(Request $request)
     {
         $input = $request->all();

         $validator = Validator::make($input, [
             'title' => 'required',
             'body' => 'required',

         ]);
         if($validator->fails()){
          // return response()->json('Validation Error.', $validator->errors());
         }
         $posts = new Post();
         $posts->title = $input['title'];
         $posts->body = $input['body'];
         $posts->user_id = 1;
         $posts->category_id = 1;
         $posts->save();

         $comment = new Comment;
         $comment->body = "Hi It is comment for post".  $posts->id;

         $posts->comments()->save($comment);


          return response()->json($posts, 200);
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

         $posts =  Post::find($id);
         $posts->post = $input['titie,body'];
         $posts->save();


          return response()->json($posts, 200);
     }
     public function destroy($id)
     {
        $posts=  Post::find($id);
        $posts->delete();
         return response()->json(null ,401);
     }
}
