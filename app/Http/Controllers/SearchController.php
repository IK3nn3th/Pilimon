<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
class SearchController extends Controller
{
    public function search(Request $req){
        $user = Auth::user();
        
        if ($req->has('search')){
            $guides = Guides::search($req->search)->paginate(6);
        }
        else{
            $guides = Guides:: paginate(6);
        }
   
       return view('dashboard.user.search')
       ->with('guides', $guides)
       ->with('user', $user);
    }
}
