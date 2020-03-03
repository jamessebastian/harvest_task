<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ActivateController extends Controller
{


    /**
     * Show activation form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showActivationForm(Request $request)
    {
        if($request->token===null){
            abort(404);
        }
        $user = User::where([['token','=',$request->token]])->get()->first();

        if(empty($user)){
            abort(404);
        }

        //login a user into the application
//        Auth::guard()->login($user);

        return view('admin.users.activate',['token'=>$request->token,'user_email'=>$user->email] );
    }


    /**
     * Activate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {


        $user = User::where([['token','=',$request->token]])->get()->first();

        if(empty($user)){
            abort(404);
        }

        $request->validate([ 'password' => ['required', 'string', 'min:8', 'confirmed'] ]);

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::guard()->login($user);

        return redirect('/time');
    }

}
