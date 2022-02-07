<?php

namespace App\Http\Controllers;
use App\Models\logs;
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


    if ( $reacterFacade->hasNotReactedTo($Guides,'Like')){
        $reacterFacade->reactTo($Guides, 'Like');  
         if ( $reacterFacade->hasReactedTo($Guides,'Unhelpful')){
            $reacterFacade->unreactTo($Guides, 'Unhelpful');    
         }
           
        
        Guides::where('id',$id) 
        ->increment('likes',1);
    }

    else{
        $reacterFacade->unreactTo($Guides, 'Like');
        Guides::where('id',$id)
        ->decrement('likes',1);
    }
   
    return redirect()->back();
    }

    public function saveUnlike($id){
        $Guides=  Guides::find($id);
  
    $user = Auth::User();
 
    $reacterFacade = $user->viaLoveReacter();

    //Get 30% of the total users
    $UserCount = User::count();
    $UserCount = $UserCount*.30;

    if ( $reacterFacade->hasNotReactedTo($Guides,'Unhelpful')){
        $reacterFacade->reactTo($Guides, 'Unhelpful'); 

        if ( $reacterFacade->hasReactedTo($Guides,'Like')){
            $reacterFacade->unreactTo($Guides, 'Like');    
         }

         //Get total dislikes
         $reactantFacade = $Guides->viaLoveReactant();
         $dislikeCounters = $reactantFacade->getReactionCounterOfType('unhelpful')->getCount();
      
         if($dislikeCounters>= $UserCount){
          
        
            $logtitle = $Guides->title;
            $Guides->delete();
    
            $logs = new logs(); 
            $logs->user= Auth::id();
            $logs->Action = "Delete";
            $logs->Role = "SYSTEM INITIATED";
            $logs->Content = "Delete guide ID: ".  $Guides->id . " with title: " .$logtitle ." due to not being helpful ";
            $logs->save();
    
            return redirect()->route('user.dashboard');
         }
    }

    else{
        $reacterFacade->unreactTo($Guides, 'Unhelpful');
        
    }
   
    return redirect()->back();
    }
}
