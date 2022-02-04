<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\Search;
class SearchController extends Controller
{
    public function search(Request $req){
        $user = Auth::user();
        
        if ($req->has('search')){
            $check = Guides::search($req->search)->get();
            $searchResult = (count($check));
            
            if( $searchResult <1) {
               //returns empty set;
                $guides = Guides::search($req->search)->paginate(6);

               //calls Search model
                $search = new Search();
                
                //Determines if the Search term exist on the table 
             
                if (Search::where('search_term',$req->search)->exists()){

                    Search::where('search_term',$req->search)->increment('Search_count',1);
                }
                else {

                $search->search_term =  $req->search;
                $search->Search_count =  1;
                $search->save();

                }
              
             
             }
             else{

                $guides = Guides::search($req->search)->paginate(6);
               
             }
        }
        else{
            $guides = Guides:: paginate(6);
            error_log("empty set");
        }
   
       return view('dashboard.user.search')
       ->with('guides', $guides)
     
       ->with('user', $user);
    }
}
