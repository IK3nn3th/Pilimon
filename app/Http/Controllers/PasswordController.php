<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function changepassword(Request $req){
    $user = User::findorfail(Auth::id());
    if($req->Newpass == $req->ConfirmPass)  {

        if(Hash::check($req->Currentpass, $user->password) ){

             

            $update = [
                'password'=> hash::make($req->Newpass)            
            ];

            User::where('id',Auth::id())->update($update);
            return redirect()->back();
        }else{

            $error ="Incorrect Current Password";
    
            return redirect()->back()->with('error',$error);
        }

    }else{

        $error ="New Password and Confirm Password does not match";

        return redirect()->back()->with('error',$error);
    }
        

    
    }
}
