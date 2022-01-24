<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CommentController extends Controller
{
    public function store($id){
      
        $validator = request()->validateWithBag('add',[
            'comment' => 'max:200',
        ]);     

        $comment = new comments();

        $comment->PostID =  $id;
        $comment->UserID =  Auth::id();
        $comment->comment = request('comment');
        $comment->save();
            return back();
    }

    public function savelike($id){
        $Guides=  Guides::find($id);
  
    $user = Auth::User();

    $reacterFacade = $user->viaLoveReacter();


    if ( $reacterFacade->hasNotReactedTo($Guides)){
        $reacterFacade->reactTo($Guides, 'Like');        
    }

    else{
        $reacterFacade->unreactTo($Guides, 'Like');
    }
   
    return redirect()->back();
    }
}
