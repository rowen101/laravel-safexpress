<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
      // Store a new comment
      public function store(Request $request, $id)
      {
          $validatedData = $request->validate([
              'content' => 'required',
          ]);

          $post = Posts::findOrFail($id);
          $post->comments()->create($validatedData);

          return redirect('/posts/' . $id)->with('success', 'Comment created successfully!');
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
