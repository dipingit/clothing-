<?php

namespace App\Http\Controllers\custom_controllers\user_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use App\User;
use App\Purchase;
use App\Product;
use App\Favourite;
use App\Rating;
use App\Notification;
use Illuminate\Support\Facades\Hash;


class indexController extends Controller
{
    function IndexPage()
    {
        $allProducts = Product::all();
        //$favourites = Favourite::where('uid', Session::get('uid'))->get();
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        return view('custom_views.user_views.index', compact('allProducts', 'favourites', 'ratings'));
        //return view('custom_views.user_views.index');
    }

    function AboutPage()
    {
        return view('custom_views.user_views.about');
    }

    function ServicePage()
    {
        return view('custom_views.user_views.services');
    }


    function UserProfile(Request $request)
    {
        //$user = User::find(Session::get('uid'));
        if((Session::has('user')))
        {
            $user = User::where('id', (Session::get('uid')))->take(1)->get();

            $allPurchases = Product::join('purchases', 'products.pid', '=', 'purchases.pid')
            ->where('purchases.purchasedby', $request->session()->get('user'))
            ->select('products.*', 'purchases.date', 'purchases.quantity', 'purchases.purchasedmethod', 'purchases.phonenumber', 'purchases.address', 'purchases.price', 'purchases.totalprice', 'purchases.size')
            ->orderBy('pid', 'DESC')
            ->getQuery()
            ->get();

            $allFavourites = Product::join('favorites', 'products.pid', '=', 'favorites.pid')
            ->where('favorites.username', $request->session()->get('user'))
            ->select('products.*')
            ->getQuery()
            ->get();

            $favourites = Favourite::where('username', Session::get('user'))->get();
            $ratings = Rating::where('username', Session::get('user'))->get();

            //return $allProducts;
            return view('custom_views.user_views.user-profile', compact('user', 'allPurchases', 'allFavourites', 'favourites', 'ratings'));

        }else{
            return redirect('/');
        }
    }

    function UpdateInfo($id, Request $request, MessageBag $errors)
    {
        $verifyUser = User::where('username', $request->input('username'))->take(1)->get();
        $verifyEmail = User::where('email', $request->input('email'))->take(1)->get();
        $verify = true;

        $user = User::find($id);
        if(($verifyUser->isEmpty())||($verifyUser[0]->username==$request->session()->get('user')))
        {
            $user->username = $request->input('username');

        }else{
            $verify = false;
        }
        
        if(($verifyEmail->isEmpty())||($verifyEmail[0]->email==$request->session()->get('email')))
        {
            $user->email = $request->input('email');

        }else{
            $verify = false;
        }

        if($verify)
        {
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
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

            return redirect('/user-profile')->with('message', 'Info Updated Successfully!');

        }else{

            if(!($verifyUser[0]->username==$request->session()->get('user'))){

                $errors->add('userEXT', "Username '".$request->input('username'). "' is already taken by someone else!");

                $errors->add('updateErr', "Username '".$request->input('username'). "' is already taken by someone else!");
            }

            if(!($verifyEmail[0]->email==$request->session()->get('email'))){

                $errors->add('emailEXT', "'".$request->input('email'). "' is already registered by someone else!");

                $errors->add('updateErr', "'".$request->input('email'). "' is already registered by someone else!");
    
            }

            return redirect()->back()->withInput()->withErrors($errors);
        }

    }

    public function ChangePassword(Request $request, $user_id)
    {
        // dd($user);
        // dd('hey');
        // $verifyUser = User::where('id', $user_id)->take(1)->get();
        // $request->session()->put('user', $verifyUser[0]->username);
        // $request->session()->put('uid', $verifyUser[0]->id);
        // $request->session()->put('email', $verifyUser[0]->email);
        // $request->session()->put('phone', $verifyUser[0]->phonenumber);
        // $request->session()->put('address', $verifyUser[0]->address);
        // $request->session()->put('usertype', $verifyUser[0]->accounttype);


        return view('custom_views.user_views.change-password', compact('user_id'));
    }

    public function ChangePasswordPost(Request $request, $user_id){

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = User::where('id', $user_id)->take(1)->get();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user[0]->password)) {
            return redirect()->back()->withInput()->withErrors(['current_password' => 'The current password is incorrect.']);
        }


        // Update the user's password
        $user[0]->password = Hash::make($request->new_password);
        $user[0]->save();
        return redirect('/user-profile')->with('message', 'Password changed successfully!');
    }

    

    function ChangePic(Request $request, MessageBag $errors)
    {
        if ($request->hasFile('profilepic')) {

            $request->validate([
                'profilepic' => 'max:5120',
            ]);

            $image = $request->file('profilepic');
            //$name = $user->username .'.'.$image->getClientOriginalExtension();
            $name = $request->session()->get('user') .'.jpg';
            $destinationPath = public_path('/custom_public/uploads/users/'.$request->session()->get('user').'/profilepic');
            $image->move($destinationPath, $name);
            //$user->profilepic = $name;

            return redirect('/user-profile')->with('message', 'Profile Pic has been Changed!');

        }else{

            $errors->add('uploadErr', "Please select a valid image file");
            return redirect()->back()->withErrors($errors);
        }
    }
    
}
