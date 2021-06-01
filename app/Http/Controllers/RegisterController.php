<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return User|false|string
     */
    public function store(Request $request)
    {
        $existingUser = User::where("email",$request->email)->get()->count();
        if($existingUser == 0){
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->contact = $request->contact;
            $newUser->password = Hash::make($request->password);
            $newUser->save();
            return json_encode(["status"=>"success","message"=>"Registration Successfully"]);
        }else{
            return json_encode(["status"=>"email","message"=>"email id already exists"]);
        }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return false|\Illuminate\Http\Response|string
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request->name;
            $user->contact = $request->contact;
            if($request->password != ""){
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return json_encode(["status"=>"success","message"=>"Profile Update Successfully"]);
        }else{
            return json_encode(["status"=>"error","message"=>"something is wrong"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
