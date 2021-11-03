<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store($id){
      
      
        $comment = new comments();

        $comment->PostID =  $id;
        $comment->UserID =  Auth::id();
        $comment->comment = request('comment');
        $comment->save();
            return back();
    }

    public function savelike($id){
    Guides::find($id)
    ->increment('likes',1);
    return back();
    }
}
