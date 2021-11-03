<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\comments;
class UserController extends Controller
{
    function index(){
        $user = Auth::user();
            if(Auth::user()->role==2){
                return view('dashboard.manager.Guides')
                ->with('user',$user)
                ->with('guides',Guides::join('users','users.id','=','guides.UserID')
                ->select('guides.views','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
                ->orderby('guides.updated_at', 'DESC')->paginate(5));
            }
    return view('dashboard.user.index')
        ->with('user',$user)
        ->with('guides',Guides::join('users','users.id','=','guides.UserID')
        ->select('guides.views','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
        ->orderby('guides.updated_at', 'DESC')->paginate(5));
    }

   
    public function deletecomment($id){
        
        $comment= comments::findorfail($id);
        $comment->delete();
        return back();
    }

    public function show($slug){
      
        Guides::where('slug',$slug)
        ->increment('views',1);
      
        $user = Auth::user();
     
        $comments = comments::join('users','users.id','=','comments.UserID')
         ->join('guides','guides.id','=','comments.PostID')
          ->select('comments.UserID','comments.id','comments.comment','comments.created_at','users.fname','users.lname')
          ->where('slug',$slug)
          ->orderby('comments.created_at', 'DESC')->paginate(5);

          if(Auth::user()->role==2){
              
          return view('dashboard.manager.show')
          ->with('comments',$comments)
          ->with('user',$user)
          ->with('guides', Guides::join('users','users.id','=','guides.UserID')
          ->select('guides.id','guides.title','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
          ->where('slug',$slug)->first());
        }


          return view('dashboard.user.show')
          ->with('comments',$comments)
          ->with('user',$user)
          ->with('guides', Guides::join('users','users.id','=','guides.UserID')
          ->select('guides.id','guides.title','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
          ->where('slug',$slug)->first());
    }
}
