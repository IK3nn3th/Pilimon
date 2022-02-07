<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\comments;
use App\Models\logs;
use App\Models\Search;
use App\Models\SearchTerms;
class UserController extends Controller
{
    function index(){
        $user = Auth::user();

        //get most searched queries without results 
        $searches = Search::select('search_term','Search_count')
                    ->orderByDesc('Search_count')
                    ->limit(5)
                    ->get();

        //get most searched queries
        $searchterms = SearchTerms::select('searchterm','Searchcount')
        ->orderByDesc('Searchcount')
        ->limit(5)
        ->get();

        $Latestguides = Guides::join('users','users.id','=','guides.UserID')
        ->select('guides.views','guides.UserID','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','guides.updated_at','users.fname','users.lname')
        ->orderby('guides.created_at', 'DESC')->limit(4)->get();

        $Updatedguides = Guides::join('users','users.id','=','guides.UserID')
        ->select('guides.views','guides.UserID','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','guides.updated_at','users.fname','users.lname')
        ->orderby('guides.updated_at', 'DESC')->limit(4)->get();


    return view('dashboard.user.index')
        ->with('searches',$searches)
        ->with('searchterms',$searchterms)
        ->with('user',$user)
        ->with('Latestguides',$Latestguides)
        ->with('Updatedguides',$Updatedguides);

    }
    function AllGuides(){
        $user = Auth::user();
        $searches = Search::select('search_term','Search_count')
        ->orderByDesc('Search_count')
        ->limit(5)
        ->get();

         //get most searched queries
         $searchterms = SearchTerms::select('searchterm','Searchcount')
         ->orderByDesc('Searchcount')
         ->limit(5)
         ->get();
 
        
        $Allguides = Guides::paginate(10);
        return view('dashboard.user.view')
        ->with('searches',$searches)
        ->with('searchterms',$searchterms)
        ->with('user',$user)
        ->with('guides',$Allguides);

    }

    function myGuides(){
        $user = Auth::user();
        $searches = Search::select('search_term','Search_count')
                    ->orderByDesc('Search_count')
                    ->limit(5)
                    ->get();

        $searchterms = SearchTerms::select('searchterm','Searchcount')
        ->orderByDesc('Searchcount')
        ->limit(5)
        ->get();

    return view('dashboard.user.guide')
        ->with('searches',$searches)
        ->with('searchterms',$searchterms)
        ->with('user',$user)
        ->with('guides',Guides::join('users','users.id','=','guides.UserID')
        ->select('guides.views','guides.UserID','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
        ->where('guides.UserID','=',$user->id)
        ->orderby('guides.updated_at', 'DESC')->paginate(6));
    }
  


    public function deletecomment($id){
        $user = Auth::user();
        $comment= comments::findorfail($id);
        $comment->delete();
        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Delete comment";
        $logs->Role = "Admin";
        $logs->Content = "Deleted comment: ". " ( " . $comment->comment . " ) " ." from user ID: ".  $id . "User name: " . $user->fname .  " " . $user->lname;
        $logs->save();
        return back();
    }

    public function show($slug){
      
        Guides::where('slug',$slug)
        ->increment('views',1);

        $user = Auth::user();
        //Get total likes
        $guides =  Guides::where('slug',$slug)->first();
        $reactantFacade = $guides->viaLoveReactant();
        $reactionCounters = $reactantFacade->getReactionCounterOfType('Like')->getCount();
        //Get total dislikes
        $guides =  Guides::where('slug',$slug)->first();
        $reactantFacade = $guides->viaLoveReactant();
        $dislikeCounters = $reactantFacade->getReactionCounterOfType('unhelpful')->getCount();
      



        //check if the user liked
        $reacterFacade = $user->viaLoveReacter();
        if ( $reacterFacade->hasNotReactedTo($guides,'Like')){
            $likeCheck = 0;     
        }
        else{
            $likeCheck = 1;  
        }
        if ( $reacterFacade->hasNotReactedTo($guides,'Unhelpful')){
            $DislikeCheck = 0;     
        }
        else{
            $DislikeCheck = 1;  
        }
        
        
        

        $comments = comments::join('users','users.id','=','comments.UserID')
         ->join('guides','guides.id','=','comments.PostID')
          ->select('comments.UserID','comments.id','comments.comment','comments.created_at','users.fname','users.lname')
          ->where('slug',$slug)
          ->orderby('comments.created_at', 'DESC')->paginate(5);

          return view('dashboard.user.show')
          ->with('comments',$comments)
          ->with('user',$user)
          ->with('likes',$reactionCounters)
          ->with('dislikeCounters',$dislikeCounters)
          ->with('DislikeCheck',$DislikeCheck)
          ->with('likeCheck',$likeCheck)
          ->with('guides', Guides::join('users','users.id','=','guides.UserID')
          ->select('guides.id','guides.title','guides.UserID','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
          ->where('slug',$slug)->first());

       
    }
}
