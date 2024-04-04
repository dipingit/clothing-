<?php

namespace App\Http\Controllers\custom_controllers\user_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    function RegisterPage()
    {
        return view('custom_views.user_views.register');
    }

    function RegisterUser(Request $request, MessageBag $errors)
    {
        $verifyUser = User::where('username', $request->input('username'))->take(1)->get();
        $verifyEmail = User::where('email', $request->input('email'))->take(1)->get();

        if(($verifyUser->isEmpty())&&($verifyEmail->isEmpty()))
        {
            $user = new User;
            $validatedData = $request->validate([
                'username' => 'required|string|max:50|alpha_dash',
                'password' => 'required|string|min:8'

            ]);
            if($validatedData){
                $user->username = $validatedData['username'];
                $user->password = Hash::make($validatedData['password']);
            
            }
            
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->gender = $request->input('gender');
            $user->dob = $request->input('DOB');
            $user->phonenumber = $request->input('pnumber');
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->area = $request->input('area');
            $user->address = $request->input('address');
            $user->accounttype = $request->input('acctype');

            if ($request->hasFile('profilepic')) {

                $request->validate([
                    'profilepic' => 'max:5120',
                ]);

                $image = $request->file('profilepic');
                //$name = $user->username .'.'.$image->getClientOriginalExtension();
                $name = $user->username .'.jpg';
                $destinationPath = public_path('/custom_public/uploads/users/'.$user->username.'/profilepic');
                $image->move($destinationPath, $name);
                $user->profilepic = $name;
            }
            $user->save();

            if(Session::has('admin'))
            {
                return redirect('/admin/usertable')->with('message', 'User Successfully Added!');;

            }else{

                return redirect('/login')->with('message', 'Registration Successful!');;
            }

        }else{

            if(count($verifyUser)>=1){

                $errors->add('userEXT', "Username already taken!");
            }

            if(count($verifyEmail)>=1){

                $errors->add('emailEXT', "This Email already registered!");
            }

            return redirect()->back()->withInput()->withErrors($errors);

        }
    }
}
