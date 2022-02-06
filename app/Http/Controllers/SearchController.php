<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\Search;
use App\Models\SearchTerms;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class SearchController extends Controller
{
    public function search(Request $req){
        $user = Auth::user();
       
        if ($req->has('search')){
            //Saving search term to count for number of searches 
            //check if the search term exist. 
            if (SearchTerms::where('searchterm',$req->search)->exists()){
                SearchTerms::where('searchterm',$req->search)->increment('Searchcount',1);
            }

            else   {
                $term = new SearchTerms();
                $term->searchterm = $req->search;
                $term->Searchcount = 1;
                $term->save();
            }




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

                $guides = Guides::search($req->search)->paginate(6)->withQueryString();
          
             }
        }
        
       return view('dashboard.user.search')
       ->with('guides', $guides)
       ->with('user', $user);
    }

 
    public function autocomplete(Request $req){

        $data = Guides:: select("index")->get();
        $indexes =[];
        $indices = [];
        foreach ($data as $index){
            $indexes[] = Str::of($index['index'])->explode(',');
        }     
        $indices = Arr::collapse($indexes);
        //removes duplicates
        $indices = array_unique($indices);
    
        return $indices;
    }


}
