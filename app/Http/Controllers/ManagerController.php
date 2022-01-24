<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\User;
use App\Models\logs;

use DataTables;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    

    
    function index(){
        $user = Auth::user();
        $data = Guides::join('users','users.id','=','guides.UserID')
        ->select('guides.id','guides.UserID','guides.title','guides.category','guides.description','guides.content','users.fname' ,'users.lname','guides.created_at','guides.updated_at','guides.views','guides.likes')
        ->get();
        
        return view('dashboard.manager.index')
        ->with('data',$data)
      
        ->with('user',$user);
    }

    public function SaveGuide(Request $req){
     
        $validator= $req->validateWithBag('add',[
            'title'=>'required|max:255|unique:guides',
            'category'=>'required',
            'desc'=>'required',
            'content'=>'required'
        ]);
        $slug = SlugService::createSlug(Guides::class, 'slug', $req->title);
        $data = new Guides();

        $data->title = request('title');
        $data->slug = $slug;
        $data->category = request('category');
        $data->description = request('desc');
        $data->content = request('content');
        $data->index = request('index');
        $data->UserID = Auth::id();
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->views = 0;
        $data->likes = 0;
        $data->save();

        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Create";
        $logs->Role = "Manager";
        $logs->Content = "Created ". request('title') . " guide";
        $logs->save();
        return redirect()->route('user.dashboard')->withErrors($validator, 'add');; 
        
        
    }

    public function showLogs()
    {   
        $user = Auth::user();
        return view('dashboard.manager.logs')->with('user',$user);
        
    }
    public function getLogs(Request $request)
    {
        $user = Auth::user();
      
    if(Auth::user()->role==2){
        $data = logs::join('users','users.id','=','logs.user')
        ->select('logs.id','users.fname','users.lname','logs.Action','logs.Content','logs.created_at')
        ->where('logs.role','Manager')
        ->get();
            return view('dashboard.manager.logs')
            ->with('data',$data)
            ->with('user',$user);

    }
    elseif(Auth::user()->role==1){
        $data = logs::join('users','users.id','=','logs.user')
        ->select('logs.id','users.fname','users.lname','logs.Action','logs.Content','logs.created_at')
        
        ->get();
        return view('dashboard.manager.logs')
            ->with('data',$data)
            ->with('user',$user);
    }
          
        
    }

   

    public function getDetails(Request $request){
            $guide_id = $request->guide_id;
            $guideDetails = Guides::find($guide_id);
       
            return response()->json(['details'=>$guideDetails]);

    }
    
    public function GuideUpdate(Request $request){
       $validator =  $request->validateWithBag('update',[
            'title'=>'required|max:255',
            'category'=>'required',
            'desc'=>'required',
            'content'=>'required'
        ]);
        $test  = $request->title;
     
        $guide_id = $request->id;
        $guideDetails = Guides::find($guide_id);
        $guideDetails->updated_at= Carbon::now();
        $guideDetails->title= $request->title;
        $guideDetails->category= $request->category;
        $guideDetails->description= $request->desc;
        $guideDetails->content= $request->content;
        $guideDetails->UserID  = Auth::id();
        $guideDetails->save();
        
        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Update";
        $logs->Role = "Manager";
        $logs->Content = "Updated guide ID: ".  $request->id . " with title: " . $request->title;
        $logs->save();
        
        return back()->withErrors($validator, 'update');   
    }
    public function deleteGuide(Request $request){
        
        $id = $request->id;
        $guide = Guides::findorFail($id);
        $logtitle = $guide->title;
        $guide->delete();

        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Delete";
        $logs->Role = "Manager";
        $logs->Content = "Delete guide ID: ".  $request->id . " with title: " .$logtitle;
        $logs->save();

        return redirect()->route('user.dashboard');
    
    }


    
}
