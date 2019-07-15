<?php

namespace App\Http\Controllers\custom_controllers\admin_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\MessageBag;
use App\Product;
use App\User;
use App\Purchase;
use App\Category;
use App\Favourite;
use App\Rating;
use App\Comment;
use App\Soldout;
use App\Notification;
use Response;

class adminController extends Controller
{
    function AdminHome()
    {
        if(Session::has('admin'))
        {
            $allRecords = (object)[];
            //$allRecords = new \stdClass();

            $allProducts = Product::all();
            $allRecords->totalProducts = $allProducts->count();

            $totalPrice = 0;
            $totalCost = 0;
            $totalQuantity = 0;

            foreach($allProducts as $product)
            {
                $totalQuantity += $product->available;
            }

            $allRecords->totalQuantity = $totalQuantity;

            $allUsers = User::all();
            $allRecords->totalUsers = $allUsers->count();
            $allRecords->totalAdmins = User::where('accounttype','Admin')->get()->count();
            $allRecords->totalCustomers = User::where('accounttype','User')->get()->count();

            $allSoldouts = Soldout::all();
            $totalSales=0;
            $totalProfit=0.0;
            foreach($allSoldouts as $sold)
            {
                $totalPrice += $sold->price;
                $totalCost += $sold->cost;
                $totalSales += $sold->sold;
                $totalProfit += (int)$sold->profit;

            }

            $allRecords->totalPrice = $totalPrice;
            $allRecords->totalCost = $totalCost;
            $allRecords->totalSales = $totalSales;
            $allRecords->totalProfit = $totalProfit;

            $notifications = Notification::orderBy('nid', 'DESC')->get();
            return view('custom_views.admin_views.adminpage', compact('allProducts', 'allRecords', 'notifications'));

            //return Response::json($allRecords);

        }else{

            return redirect('/');
        }
        
    }

    function UserTable()
    {
        if(Session::has('admin'))
        {
            $allUsers = User::all();
            return view('custom_views.admin_views.adminpage-user', compact('allUsers'));
            
        }else{

            return redirect('/');
        }
        
    }

    function PurchaseTable()
    {
        if(Session::has('admin'))
        {
            $allPurchases = Purchase::all();
            return view('custom_views.admin_views.adminpage-purchase', compact('allPurchases'));
            
        }else{

            return redirect('/');
        }
        
    }

    function MessageTable()
    {
        if(Session::has('admin'))
        {
            $allProducts = Product::all();
            return view('custom_views.admin_views.adminpage', compact('allProducts'));
            
        }else{

            return redirect('/');
        }
        
    }

    function AddUser($type)
    {
        if(Session::has('admin'))
        {
            return view('custom_views.admin_views.adduser', compact('type'));
            
        }else{

            return redirect('/');
        }
    }

    function AddProductGet()
    {
        if(Session::has('admin'))
        {
            $categories = Category::where('cgfor', 'Men')->get()->sortBy('category'); //sortByDesc
            return view('custom_views.admin_views.add-product', compact('categories'));
            
        }else{

            return redirect('/');
        }
    }

    function AddProductGetCategory(Request $request)
    {
        if(Session::has('admin'))
        {
            $pfor = $request->input('pfor');
            $categories = Category::where('cgfor', $pfor)->get()->sortBy('category'); //sortByDesc
            return response()->json($categories);
            //return Response::json(array('success'=>true, 'res'=>$categories));
            
        }else{

            return redirect('/');
        }
    }

    function AddProductPost(Request $request, MessageBag $errors)
    {
        if(Session::has('admin'))
        {
            $verifyProduct = Product::where('pname', $request->input('pname'))->take(1)->get();
            $size="";
            $categoryNew="";
            $available = 0;

            if($verifyProduct->isEmpty())
            {
                if( $request->has('alls') ){
                    $size = "XS,S,M,L,XL,XXL";
                    $xsamount = $request->input('allsamount');
                    $samount = $request->input('allsamount');
                    $mamount = $request->input('allsamount');
                    $lamount = $request->input('allsamount');
                    $xlamount = $request->input('allsamount');
                    $xxlamount = $request->input('allsamount');

                    $available = (int)$xsamount*6;
                }else{

                    if( $request->has('xs') ){
                        $size = $size . "XS, ";
                        $xsamount = $request->input('xsamount');
                        $available += (int)$xsamount;
                    }else{
                        $xsamount = 0;
                    }

                    if( $request->has('s') ){
                        $size = $size . "S, ";
                        $samount = $request->input('samount');
                        $available += (int)$samount;
                    }else{
                        $samount = 0;
                    }

                    if( $request->has('m') ){
                        $size = $size . "M, ";
                        $mamount = $request->input('mamount');
                        $available += (int)$mamount;
                    }else{
                        $mamount = 0;
                    }

                    if( $request->has('l') ){
                        $size = $size . "L, ";
                        $lamount = $request->input('lamount');
                        $available += (int)$lamount;
                    }else{
                        $lamount = 0;
                    }

                    if( $request->has('xl') ){
                        $size = $size . "XL, ";
                        $xlamount = $request->input('xlamount');
                        $available += (int)$xlamount;
                    }else{
                        $xlamount = 0;
                    }

                    if( $request->has('xxl') ){
                        $size = $size . "XXL, ";
                        $xxlamount = $request->input('xxlamount');
                        $available += (int)$xxlamount;
                    }else{
                        $xxlamount = 0;
                    }
                }

                if( !empty($request->input('categoryNew')) ){
                    $category = new Category;
                    $category->category = $request->input('categoryNew');
                    $category->cgfor = $request->input('pfor');
                    $category->save();
                    $categoryNew = $request->input('categoryNew');
                }else{

                    $categoryNew = $request->input('category');
                }

                $product = new Product;
                $product->pname = $request->input('pname');
                $product->category = $categoryNew;
                $product->pfor = $request->input('pfor');
                $product->size = $size;
                $product->available = $available;
                $product->xs_available = $xsamount;
                $product->s_available = $samount;
                $product->m_available = $mamount;
                $product->l_available = $lamount;
                $product->xl_available = $xlamount;
                $product->xxl_available = $xxlamount;
                $product->price = $request->input('price');
                $product->currency = $request->input('currency');
                $product->cost = $request->input('cost');
                $product->offer = $request->input('offer');

                if ($request->hasFile('productpics')) {

                    $request->validate([
                        'productpics' => 'max:5120',
                    ]);

                    $images = $request->file('productpics');
                    //return $images;
                    $i=0;
                    foreach($images as $image){
                        //$name = $product->pname. $i .'.'.$image->getClientOriginalExtension();
                        $name = $product->pname. $i .'.jpg';
                        $destinationPath = public_path('/custom_public/uploads/products/'.$product->pname.'/images');
                        $image->move($destinationPath, $name);
                        //$product->image = $name;
                        $i++;
                    }
                }

                $product->save();

                return redirect('/admin')->with('message', 'Product Successfully Added!');


            }else{
                $errors->add('itemEXT', "This Product already exist!");
                return redirect()->back()->withInput()->withErrors($errors);

            }
            
        }else{

            return redirect('/');
        }
    }

    function UpdateProductGet($pid)
    {
        if(Session::has('admin'))
        {
            $product = Product::where('pid', $pid)->get();

            Session::put('pname', $product[0]->pname);

            $sizes = $product[0]->size;
            $sizesArry = explode(',',$sizes);
            $availableSizes = array('XS','S','M','L','XL','XXL');
            
            $categories = Category::where('cgfor', 'Men')->get()->sortBy('category'); 
            return view('custom_views.admin_views.edit-product', compact('product', 'sizesArry','availableSizes','categories'));
            
        }else{

            return redirect('/');
        }
    }

    function UpdateUserGet($id)
    {
        if(Session::has('admin'))
        {
            $user = User::where('id', $id)->get();
            
            return view('custom_views.admin_views.update-user', compact('user'));
            
        }else{

            return redirect('/');
        }
    }

    function UpdateProductPost($pid, Request $request, MessageBag $errors)
    {
        if(Session::has('admin'))
        {
            $size="";
            $categoryNew="";
            $available = 0;

            $verifyPname = Product::where('pname', $request->input('pname'))->get();

            if(($verifyPname->isEmpty())||($verifyPname[0]->pname==$request->session()->get('pname')))
            {
                if( $request->has('alls') ){
                    $size = "XS,S,M,L,XL,XXL";
                    $xsamount = $request->input('allsamount');
                    $samount = $request->input('allsamount');
                    $mamount = $request->input('allsamount');
                    $lamount = $request->input('allsamount');
                    $xlamount = $request->input('allsamount');
                    $xxlamount = $request->input('allsamount');

                    $available = (int)$xsamount*6;
                }else{

                    if( $request->has('xs') ){
                        $size = $size . $request->input('xs') . ",";
                        $xsamount = $request->input('xsamount');
                        $available += (int)$xsamount;
                    }else{
                        $xsamount = 0;
                    }

                    if( $request->has('s') ){
                        $size = $size . $request->input('s') . ",";
                        $samount = $request->input('samount');
                        $available += (int)$samount;
                    }else{
                        $samount = 0;
                    }

                    if( $request->has('m') ){
                        $size = $size . $request->input('m') . ",";
                        $mamount = $request->input('mamount');
                        $available += (int)$mamount;
                    }else{
                        $mamount = 0;
                    }

                    if( $request->has('l') ){
                        $size = $size . $request->input('l') . ",";
                        $lamount = $request->input('lamount');
                        $available += (int)$lamount;
                    }else{
                        $lamount = 0;
                    }

                    if( $request->has('xl') ){
                        $size = $size . $request->input('xl') . ",";
                        $xlamount = $request->input('xlamount');
                        $available += (int)$xlamount;
                    }else{
                        $xlamount = 0;
                    }

                    if( $request->has('xxl') ){
                        $size = $size . $request->input('xxl') . ",";
                        $xxlamount = $request->input('xxlamount');
                        $available += (int)$xxlamount;
                    }else{
                        $xxlamount = 0;
                    }
                }

                if( !empty($request->input('categoryNew')) ){
                    $category = new Category;
                    $category->category = $request->input('categoryNew');
                    $category->cgfor = $request->input('pfor');
                    $category->save();
                    $categoryNew = $request->input('categoryNew');
                }else{

                    $categoryNew = $request->input('category');
                }

                
                $product = Product::find($pid);
                $product->pname = $request->input('pname');
                $product->category = $categoryNew;
                $product->pfor = $request->input('pfor');
                $product->size = $size;

                if( $request->has('merge') ){
                    $product->available += $available;
                    $product->xs_available += $xsamount;
                    $product->s_available += $samount;
                    $product->m_available += $mamount;
                    $product->l_available += $lamount;
                    $product->xl_available += $xlamount;
                    $product->xxl_available += $xxlamount;
                }else{
                    $product->available = $available;
                    $product->xs_available = $xsamount;
                    $product->s_available = $samount;
                    $product->m_available = $mamount;
                    $product->l_available = $lamount;
                    $product->xl_available = $xlamount;
                    $product->xxl_available = $xxlamount;
                }
                
                $product->price = $request->input('price');
                $product->currency = $request->input('currency');
                $product->cost = $request->input('cost');
                $product->offer = $request->input('offer');

                if ($request->hasFile('productpics')) {

                    $request->validate([
                        'productpics' => 'max:5120',
                    ]);

                    $images = $request->file('productpics');
                    //return $images;
                    $i=0;
                    foreach($images as $image){
                        //$name = $product->pname. $i .'.'.$image->getClientOriginalExtension();
                        $name = $product->pname. $i .'.jpg';
                        $destinationPath = public_path('/custom_public/uploads/products/'.$product->pname.'/images');
                        $image->move($destinationPath, $name);
                        //$product->image = $name;
                        $i++;
                    }
                }

                $product->save();

                return redirect('/admin')->with('message', 'Product Successfully Updated!');

            }else{

                $errors->add('itemEXT', "Product name '".$request->input('pname'). "' is already used for another Product!");
                return redirect()->back()->withInput()->withErrors($errors);
            }

            
        }else{

            return redirect('/');
        }
    }

    function UpdateUserPost($id, Request $request, MessageBag $errors)
    {
        if(Session::has('admin'))
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
                $user->password = $request->input('password');
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

                return redirect('/admin/usertable')->with('message', 'User Successfully Updated!');

            }else{
                if(!($verifyUser[0]->username==$request->session()->get('user'))){

                    $errors->add('userEXT', "Username '".$request->input('username'). "' is already taken by someone else!");
                }

                if(!($verifyEmail[0]->email==$request->session()->get('email'))){

                    $errors->add('emailEXT', "'".$request->input('email'). "' is already registered by someone else!");
        
                }

                return redirect()->back()->withInput()->withErrors($errors);
            }

        }else{

            return redirect('/');
        }

    }

    function DeleteProduct($pid)
    {
        if(Session::has('admin'))
        {
            $product = Product::find($pid);
            $product->delete();

            return redirect('/admin');
            
        }else{

            return redirect('/');
        }
    }

    function DeleteUser($id)
    {
        if(Session::has('admin'))
        {
            $user = User::find($id);
            $image_path = public_path("custom_public\uploads\users\\".$user->username);
            //Storage::disk('public')->exists('images\test_image.jpg');
            //File::exists($image_path);
            //Storage::exists('your-path');
            //$exists = Storage::disk('local')->exists('file.jpg');
            if (File::exists($image_path)) {
                //File::delete($image_path);
                //unlink($image_path);
                //File::deleteDirectory(public_path($image_path));
                //Storage::delete($image_path);
                Storage::deleteDirectory($image_path);
                return $image_path;
            }

            $user->delete();
            //return $image_path;
            return redirect('/admin/usertable');
            
        }else{

            return redirect('/');
        }
    }

}
