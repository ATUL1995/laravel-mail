<?php

namespace App\Http\Controllers;


use App\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Accountcontroller extends Controller
{
    public function activate(Request $request,$token)
    {
        $userToken = UserToken::where('token',$token)->first();

        if($userToken){
            $userToken->status=1;

            $userToken->save();

            Auth::loginUsingId($userToken->user_id);
            return redirect('/home')->with('message','your account has been activated');
        }else{
            return redirect('/register')->with('message','Invalid token try again')->with('error',true);
        }

    }
}
