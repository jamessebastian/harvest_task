<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('organisation_id','=',Auth::user()->organisation->id)->get();
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->with(['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(['name'=>'required|string|min:2',
            'email'=>'string|email|unique:users',
            'roles'=>'required',
        ]);

        $token = md5(uniqid(rand(), true));
        $user = new User;
        $user->token = $token;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->organisation_id = Auth::user()->organisation->id;
        $user->save();

        $user->roles()->sync($request->roles);


        Mail::raw("Click this link to login to your account- http://127.0.0.1:8000/invitation?token=".$token, function($message){
            $message->to(request('email'))->subject('Invitation');
        });

        return redirect('/admin/users/create')->with('message','Email sent!');

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')) {
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();
        return view('admin.users.edit')->with(['roles'=>$roles,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Validation
        $request->validate(['name'=>'required|string|min:2',
                            'email'=>'string|email|unique:users,email,'.$user->id.'',
                            'roles'=>'required',
                            ]);


        $user->roles()->sync($request->roles);
        $user->name=$request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')) {
            return redirect()->route('admin.users.index');
        }

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
