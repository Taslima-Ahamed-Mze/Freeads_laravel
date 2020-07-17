<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       if(Auth::user())
       {
           $user = User::find(Auth::user()->id);

           if($user)
            {
                return view('user.edit')->withUser($user);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if($user)
        {
            $validate = null;
            if(Auth::user()->email === $request['email'])
            {
                $validate = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    
                ]);
            }else{
                $validate = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255','unique:users'],
                    
                ]);
            }
            
            if($validate)
            {
                $user->name = $request['name'];
                $user->email = $request['email'];
                if($request['password'] != "")
                {
                    $user->password = Hash::make($request['password']);
                }
                $user->save();
                $request->session()->flash('success',"Votre profile est modifié");
                return redirect()->back();
            }else{
                return redirect()->back();
            }
            

        }else{
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
 
            if($user)
            {
                $user->delete();
                redirect('/home');
                return view('user.delete')->withUser($user);
             }else{
                 return redirect()->back();
             }
         }
    }
}
