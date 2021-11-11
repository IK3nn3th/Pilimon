<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
class SearchController extends Controller
{
    public function search(Request $req){
        $user = Auth::user();

        if(empty($_GET['query'])){
            return view('dashboard.user.index')
            ->with('user',$user)
            ->with('guides',Guides::join('users','users.id','=','guides.UserID')
            ->select('guides.views','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
            ->orderby('guides.updated_at', 'DESC')->paginate(6));

            
        }else {
            
            $search = $_GET['query'];
            error_log($search);
            $guides = Guides::join('users','users.id','=','guides.UserID')
            ->select('guides.views','guides.id','guides.title','guides.slug','guides.category','guides.description','guides.content','guides.updated_at','users.fname','users.lname')
            ->where('title','LIKE','%'.$search.'%')
            ->orderby('guides.updated_at', 'DESC')->paginate(6);

            return view ('dashboard.user.search')
            ->with('guides',$guides)
            ->with('user',$user);   
            
        }
       
    }
}
