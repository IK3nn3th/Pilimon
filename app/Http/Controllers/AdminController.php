<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{   
    
    function index(){

        $user = User::all();
        $name = Auth::user();
       
        return view('dashboard.admins.index', ['users'=>$user,])
        
        ->with('name',$name)
        ->with('temppass',"");
    }
    public function getLogs(Request $request)
    {
        $name = Auth::user();
  
        $data = logs::join('users','users.id','=','logs.user')
        ->select('logs.id','users.fname','users.lname','logs.Action','logs.Content','logs.created_at')
      
        ->get();
            
            return view('dashboard.admins.logs')
            ->with('data',$data)
            ->with('user',$name);   
        
    }
    public function resetpass(Request $request)
    {   
        $name = Auth::user();
        $user = User::all();
        $temppass = Str::random(8);
        
       
        $update = [
            'password'=> hash::make($temppass)
           

        ];
        User::where('id',$request->id)->update($update);
        
        

        return redirect()->route('admin.dashboard', ['temppass'=>$temppass,]) 
        ->with('temppass',$temppass)
        ->with('name',$name);

    }
    public function store(Request $req){
        $validator = $req->validateWithBag('add',[
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:8'
        ]);     


        $user = new User();
        $user->fname = request('fname');
        $user->lname = request('lname');
        $user->email = request('email');
        $user->password = hash::make(request('password'));
        $user->role = request('role');
        $user->status = request('status');
        $user->save();
       
        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Add user";
        $logs->Role = "Admin";
        $logs->Content = "Added the user ". request('fname') ." ". request('lname') ." guide";
        $logs->save();
        error_log($validator);
        return redirect()->route('admin.dashboard')->withErrors($validator, 'add'); 
        
        
    }

    public function getUser(Request $request){
        $user_id = $request->user_id;
        $userDetails = User::find($user_id);
   
        return response()->json(['details'=>$userDetails]);

}

    public function EditUser(Request $request){
       $validator =  $request->validateWithBag('Update',[
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            
        ]);     

        
        $update = [
                'fname'=> $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'role' => $request->role,
                'status' => $request->status

        ];

        
        User::where('id',$request->id)->update($update);
        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Update user";
        $logs->Role = "Admin";
        $logs->Content = "Updated user information for User ID: ". $request->id. " with full name: " . $request->fname." ". $request->lname ;
        $logs->save();

            return redirect()->route('admin.dashboard')->withErrors($validator, 'update'); ; 
        
        
    }

    public function destroy(Request $request){
        
        $id = $request->id;
        $user = User::findorFail($id);
        $logname = $user->fname . $user->lname;
        $user->delete();

        $logs = new logs(); 
        $logs->user= Auth::id();
        $logs->Action = "Delete user";
        $logs->Role = "Admin";
        $logs->Content = "Delete user ID: ".  $request->id . " with full name: " .$logname;
        $logs->save();

       return redirect()->route('admin.dashboard'); 
    
    }



}


