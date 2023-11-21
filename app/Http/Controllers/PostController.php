<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class PostController extends Controller
{
   /**
     * Show the post for a given id.
     */
    public function show(string $id): View
    {
        // Get the card.
        $post = Post::findOrFail($id); 

        // Use the pages.card template to display the card.
        return view('pages.post', [
            'post' => $post
        ]);
    }

    /**
     * Show all the posts available in the database.
     */
    public function list()
    {
      //check if user is logged in
      if (Auth::check()) {
        //user is logged in
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.posts', ['posts' => $posts]);
      } else {
        //user is not logged in
        return redirect('/');
      }
    }

    public function forYou()
    {
        // Check if user is logged in
      if (Auth::check()) {
        // User is logged in
        $user = Auth::user();

        // Get the IDs of users that the current user follows
        $followingIds = $user->following()->pluck('users.user_id')->toArray();
        
        // Fetch posts only from these users
        $posts = Post::with('user')
                    ->whereIn('owner_id', $followingIds)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('pages.posts', ['posts' => $posts]);
      } 
      else {
          // User is not logged in
          return redirect('/');
        }
    }

    public function create()
    {
        return view('pages.postsCreate');
    }

    public function store(Request $request)
    {
      $validatedData = $request->validate([
          'content' => 'required|max:1000',
      ]);

      $post = new Post;
      $post->content = $validatedData['content'];
      $post->owner_id = Auth::id(); // Set the owner_id to the current user's ID
      $post->save();

      return redirect('/home')->with('success', 'Post created successfully!');
    }
}
