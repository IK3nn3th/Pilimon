<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    
    function index(){
        $user = Auth::user();
        return view('dashboard.manager.index')->with('user',$user);
    }

    public function SaveGuide(Request $req){
     
        $req->validate([
            'title'=>'required',
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
        $data->UserID = Auth::id();
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->views = 0;
        $data->save();
        return redirect()->route('manager.dashboard'); 
        
        
    }

    public function getGuides(Request $request)
    {
      
        if ($request->ajax()) {
            $data = Guides::join('users','users.id','=','guides.UserID')
            ->select('guides.id','guides.title','guides.category','guides.description','guides.content','users.fname','guides.created_at','guides.updated_at','guides.views','guides.likes')
            ->get();
            return Datatables::of($data)
                

                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#editGuideModal" class="edit" id="edit" data-id="'.$row['id'].'" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteGuideModal" class="delete" id="delete" data-id="'.$row['id'].'" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                    return $actionBtn;
                })
                ->addColumn('updated_at', function($row)
                {
                    $date = date("jS M Y", strtotime($row->updated_at));
                    return $date;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getDetails(Request $request){
            $guide_id = $request->guide_id;
            $guideDetails = Guides::find($guide_id);
           
            return response()->json(['details'=>$guideDetails]);

    }
    
    public function GuideUpdate(Request $request){
        $guide_id = $request->id;
        $guideDetails = Guides::find($guide_id);
        $guideDetails->updated_at= Carbon::now();
        $guideDetails->title= $request->title;
        $guideDetails->category= $request->category;
        $guideDetails->description= $request->desc;
        $guideDetails->content= $request->content;
        $guideDetails->UserID  = Auth::id();
        $guideDetails->save();
   
        return redirect()->route('manager.dashboard');   
    }
    public function deleteGuide(Request $request){
        
        $id = $request->id;
        $guide = Guides::findorFail($id);
        $guide->delete();
       return redirect()->route('manager.dashboard'); 
    
    }
}
