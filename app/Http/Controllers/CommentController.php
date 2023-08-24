<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
      // Store a new comment
      public function store(Request $request)
      {
          try {
            $this->validate($request, [
                'comment' => 'required',
            ]);
            //dd($request->all());
            $data = new Comment();
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->website = $request->input('website');
            $data->comment = $request->input('comment');
            $data->posts_id = $request->input('posts_id');
            // $data->is_active = $request->input('is_active');
            $data->save();

            return back()->with('success', 'Comment created successfully!');
       } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
      }

      // Delete a comment
      public function destroy($id)
      {
          $comment = Comment::findOrFail($id);
          $postId = $comment->post_id;
          $comment->delete();

          return redirect('admin/post/' . $postId)->with('success', 'Comment deleted successfully!');
      }
}
