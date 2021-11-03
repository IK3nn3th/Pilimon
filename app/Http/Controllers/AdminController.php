<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{   
    
    function index(){

        $user = User::all();
        $name = Auth::user();
        return view('dashboard.admins.index', ['users'=>$user,])->with('name',$name);
    }

    function profile(){
        return view('dashboard.admins.profile');
    }
    function settings(){
        return view('dashboard.admins.settings');
    }

    
    public function store(Request $req){
        $req->validate([
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

      
            return redirect()->route('admin.dashboard'); 
        
        
    }

    public function EditUser(Request $request){
        $request->validate([
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
            return redirect()->route('admin.dashboard'); 
        
        
    }

    public function destroy(Request $request){
        
        $id = $request->id;
        $user = User::findorFail($id);
        $user->delete();
       return redirect()->route('admin.dashboard'); 
    
    }



}


