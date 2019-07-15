<?php

namespace App\Http\Controllers\custom_controllers\user_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use App\Product;
use App\Purchase;
use App\Soldout;
use App\Favourite;
use App\Rating;
use App\Comment;
use App\Notification;

class productController extends Controller
{
    function AllClothings()
    {
        $title = "All Clothings";
        $allProducts = Product::all();
        //$favourites = Favourite::where('uid', Session::get('uid'))->get();
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        return view('custom_views.user_views.products', compact('title', 'allProducts', 'favourites', 'ratings'));
    }

    function MensClothing()
    {
        $title = "Men's Clothing";
        $allProducts = Product::where('pfor','Men')->get();
        //$favourites = Favourite::where('uid', Session::get('uid'))->get();
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        return view('custom_views.user_views.products', compact('title', 'allProducts', 'favourites', 'ratings'));
        
    }

    function WomensClothing()
    {
        $title = "Women's Clothing";
        $allProducts = Product::where('pfor','Women')->get();
        //$favourites = Favourite::where('uid', Session::get('uid'))->get();
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        return view('custom_views.user_views.products', compact('title', 'allProducts', 'favourites', 'ratings'));
    }

    function ChildsClothing()
    {
        $title = "Child's Clothing";
        $allProducts = Product::where('pfor','Child')->get();
        //$favourites = Favourite::where('uid', Session::get('uid'))->get();
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        return view('custom_views.user_views.products', compact('title', 'allProducts', 'favourites', 'ratings'));
    }

    function ClothDetails($pid)
    {
        //$product = Product::where('pid', $pid)->get();
        $product = Product::find($pid);
        //return $product;
        $allComments = Comment::where('cmnt_for', $pid)->where('nested_of', 0)->get();
        $nestedComments = Comment::where('nested_of', '!=' , 0)->get();
        $favourites = Favourite::where('username', Session::get('user'))->where('pid', $pid)->get();
        //$ratings = Rating::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->where('pid', $pid)->get();

        return view('custom_views.user_views.product-details', compact('product', 'allComments', 'nestedComments', 'favourites', 'ratings'));
    }

    function AddProductComment(Request $request, MessageBag $errors)
    {
        if(Session::has('user'))
        {
            /*function get_local_time(){ //works fine with internet connection!

                $ip = file_get_contents("http://ipecho.net/plain");
             
                $url = 'http://ip-api.com/json/'.$ip;
             
                $tz = file_get_contents($url);
             
                $tz = json_decode($tz,true)['timezone'];
             
                return $tz;
             
             }
            $date = Carbon::now(get_local_time()); */

            //$date = Carbon::now();
            $date = Carbon::now('Asia/Dhaka'); //set time according to local-time / time-zone
            $createdDate = $date->toFormattedDateString();
            $createdTime = $date->toTimeString(); 

            $comment = new Comment;
            $comment->cmnt_text = $request->input('cmnt_text');
            $comment->cmnt_rating = $request->input('cmnt_rating');
            $comment->cmnt_for = $request->input('cmnt_for');
            $comment->cmnted_by = $request->session()->get('uid');

            if($request->session()->has('admin'))
            {
                $comment->cmnter = "Clothing.com";

            }else{
            
                $comment->cmnter = $request->session()->get('user');
            }

            $comment->nested_of = $request->input('nested_of');
            $comment->created_date = $createdDate;
            $comment->created_time = $createdTime;

            if( $request->has('mention') )
            {
                $comment->mention = $request->input('mention');
            }

            $comment->save();

            return redirect()->back()->with('message', 'Your Comment has been posted');

        }else{

            $errors->add('loginReq', "Please login to submit a Comment");
            return redirect()->back()->withInput()->withErrors($errors);
        }
        
    }

    function UpdateProductComment(Request $request, MessageBag $errors)
    {
        if(Session::has('user'))
        {
            /*function get_local_time(){ //works fine with internet connection!

                $ip = file_get_contents("http://ipecho.net/plain");
             
                $url = 'http://ip-api.com/json/'.$ip;
             
                $tz = file_get_contents($url);
             
                $tz = json_decode($tz,true)['timezone'];
             
                return $tz;
             
             }
            $date = Carbon::now(get_local_time()); */

            //$date = Carbon::now();
            $date = Carbon::now('Asia/Dhaka'); //set time according to local-time / time-zone
            $createdDate = $date->toFormattedDateString();
            $createdTime = $date->toTimeString(); 

            $comment = Comment::find($request->input('cmntid'));
            $comment->cmnt_text = $request->input('cmnt_text');
            $comment->cmnt_rating = $request->input('cmnt_rating');
            $comment->modified_date = $createdDate;
            $comment->modified_time = $createdTime;
            $comment->save();

            return redirect()->back()->with('message', 'Your Comment has been Updated successfully');

        }else{

            $errors->add('loginReq', "Please login to submit/Update a Comment");
            return redirect()->back()->withInput()->withErrors($errors);
        }
        
    }

    function DeleteProductComment(Request $request, MessageBag $errors)
    {
        if(Session::has('user'))
        {
            $comment = Comment::find($request->input('cmntid'));
            if($request->input('cmnt_type')=="normal")
            {
                $nestedComments = Comment::where('nested_of', $request->input('cmntid'))->get();

                if($nestedComments != null)
                {
                    foreach($nestedComments as $nstedCmnt)
                    {
                        $nstedCmnt->delete();
                    }
                }

                $comment->delete();

            }else if($request->input('cmnt_type')=="nested")
            {
                $comment->delete();
            }

            return redirect()->back()->with('message', 'Your Comment has been Deleted successfully');

        }else{

            $errors->add('loginReq', "Please login to submit/Update/delete a Comment");
            return redirect()->back()->withInput()->withErrors($errors);
        }
        
    }

    function SearchCloth(Request $request)
    {
        $typo= $request->input('typo');
        $title= $request->input('title');
        $acctype = $request->session()->get('usertype');
        $favourites = Favourite::where('username', Session::get('user'))->get();
        $ratings = Rating::where('username', Session::get('user'))->get();

        if($title == "All Clothings")
        {
            $allProducts = Product::where('pname', 'like', $typo)->orWhere('category', 'like', $typo)->orWhere('pfor', 'like', $typo)->get();

            //if($allProducts!=null)
            //{
                $searchView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();
            //}else{
                //$searchView = null;
            //}

            $allProducts = Product::all();

            $oldView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();


            //return response()->json($allProducts);
            //return response()->json(['success'=>true, 'result'=>$searchResult, 'pfor'=>$productFor, 'favourites'=>$favs, 'ratings'=>$rates, 'usertype'=>$acctype]);

        }
        else if($title == "Men's Clothing"){

            $mensProduct = Product::where('pfor', 'Men');
            $allProducts=$mensProduct->where('pname', 'like', $typo)->orWhere('category', 'like', $typo)->get();

            $searchView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            $allProducts = Product::where('pfor', 'Men')->get();

            $oldView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            //return response()->json($mensProduct);
            //return response()->json(['success'=>true, 'result'=>$searchResult, 'pfor'=>$productFor, 'favourites'=>$favs, 'ratings'=>$rates, 'usertype'=>$acctype]);

        }
        else if($title == "Women's Clothing"){

            $womensProduct = Product::where('pfor', 'Women');
            $allProducts=$womensProduct->where('pname', 'like', $typo)->orWhere('category', 'like', $typo)->get();

            $searchView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            $allProducts = Product::where('pfor', 'Women')->get();

            $oldView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            //return response()->json($womensProduct);
            //return response()->json(['success'=>true, 'result'=>$searchResult, 'pfor'=>$productFor, 'favourites'=>$favs, 'ratings'=>$rates, 'usertype'=>$acctype]);

        }
        else if($title == "Child's Clothing"){

            $childsProduct = Product::where('pfor', 'Child');
            $allProducts=$childsProduct->where('pname', 'like', $typo)->orWhere('category', 'like', $typo)->get();

            $searchView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            $allProducts = Product::where('pfor', 'Child')->get();

            $oldView = view("custom_views.user_views.product-search",compact('allProducts', 'favourites', 'ratings'))->render();

            //return response()->json($childsProduct);
            //return response()->json(['success'=>true, 'result'=>$searchResult, 'pfor'=>$productFor, 'favourites'=>$favs, 'ratings'=>$rates, 'usertype'=>$acctype]);

        }

        //return response()->json($searchView);

        return response()->json(['success'=>true, 'searchview'=>$searchView, 'oldview'=>$oldView]);
    }

    function AddToFavourite(Request $request)
    {
        if(Session::has('user'))
        {
            $pid= $request->input('productid');
            $uid= $request->session()->get('uid');
            $user= $request->session()->get('user');

            $favourite = Favourite::where('pid', $pid)->where('uid', $uid)->take(1)->get();
            if($favourite->isEmpty())
            {
                $favourite = new Favourite;
                $favourite->pid = $pid;
                $favourite->uid = $uid;
                $favourite->username = $user;
                $favourite->save();

            }else{
                $favourite[0]->delete();
            }

            return $favourite;

        }else{

            return "A2F <3 : You are not logged in";
        }
        
    }

    function GiveRating(Request $request)
    {
        if(Session::has('user'))
        {
            $pid= $request->input('productid');
            $pname= $request->input('productname');
            $uid= $request->session()->get('uid');
            $user= $request->session()->get('user');
            $userrating = $request->input('rating');

            //return $userrating;

            $rating = Rating::where('pid', $pid)->where('uid', $uid)->take(1)->get();

            if($rating->isEmpty())
            {
                //return "Rating empty";
                $rating = new Rating;
                $rating->pid = $pid;
                $rating->pname = $pname;
                $rating->uid = $uid;
                $rating->username = $user;
                $rating->rating = $userrating;
                $rating->save();

            }else{

                $rating[0]->pname = $pname;
                $rating[0]->username = $user;
                $rating[0]->rating = $userrating;
                $rating[0]->save();
            }

            $productRating = Rating::where('pid', $pid)->get();
            $totalRaters = count($productRating);
            $totalRates=0.0;

            foreach($productRating as $overall)
            {
                $totalRates+=$overall->rating;
            }
            $avgrate = $totalRates / $totalRaters;

            $product = Product::find($pid);
            $product->rating = $avgrate;
            $product->save();

            //return $product;

            //return $rating;

            return "Average rating : ".$avgrate . " , All raters : ".$totalRaters." , Total rates : ".$totalRates;

        }else{

            return "GiveRating * : You are not logged in";
        }
        
    }

    function AddToCart(Request $request)
    {
        $allCartItems= $request->input('cartitems');
        $request->session()->put('cartitems', $allCartItems);
        $ssnitms = $request->session()->get('cartitems');

        //return response()->json($allCartItems);
        return response()->json($ssnitms);
        
    }

    function CartList(Request $request, MessageBag $errors)
    {
        if(Session::has('user'))
        {
            $allCartItems = $request->session()->get('cartitems');

            return view('custom_views.user_views.cartlist', compact('allCartItems'));

        }else{
            $errors->add('loginReq', "Please login to Purchase Something");
            return redirect('/')->withErrors($errors);
        }
        
    }

    function CheckOut(Request $request)
    {
        if(Session::has('user'))
        {
            $allCartItems=Session::get('cartitems');
            foreach($allCartItems as $item)
            {
                $purchase = new Purchase;
                $purchase->pid = (int)$item['pid'];
                $purchase->pname = $item['pname'];
                $purchase->category = $item['category'];
                $purchase->pfor = $item['pfor'];
                $purchase->size = $item['quantityFor'];
                $purchase->quantity = (int)$item['quantity'];
                $purchase->price = (int)$item['price'];
                $purchase->cost = (int)$item['cost'];
                $purchase->offer = (int)$item['offer'];
                $purchase->currency = $item['currency'];
                $purchase->purchasedby = Session::get('user');
                $purchase->date = date('Y-m-d');
                $purchase->purchasedmethod = $request->input('purchase-method');
                $purchase->phonenumber = $request->input('pnumber');
                $purchase->address = $request->input('address');
                $purchase->totalprice = (float)$item['total'];
                $purchase->save();

                $size = $item['quantityFor'];
                $totalprice = (int)$item['price']*(int)$item['quantity'];
                $totalcost = (int)$item['cost']*(int)$item['quantity'];

                //$soldout = Soldout::where('pname', $item['pname'])->take(1)->get();
                $soldout = Soldout::where('pid', $item['pid'])->take(1)->get();
                
                if($soldout->isEmpty())
                {
                    $soldout = new Soldout;
                    $soldout->pid = (int)$item['pid'];
                    $soldout->pname = $item['pname'];
                    $soldout->category = $item['category'];
                    $soldout->pfor = $item['pfor'];
                    $soldout->size = $size;
                    $soldout->sold = (int)$item['quantity'];
                    if($size=="XS")
                    {
                        $soldout->xs_sold = (int)$item['quantity'];
    
                    }else if($size=="S")
                    {
                        $soldout->s_sold = (int)$item['quantity'];
    
                    }else if($size=="M")
                    {
                        $soldout->m_sold = (int)$item['quantity'];
    
                    }else if($size=="L")
                    {
                        $soldout->l_sold = (int)$item['quantity'];
    
                    }else if($size=="XL")
                    {
                        $soldout->xl_sold = (int)$item['quantity'];
    
                    }else if($size=="XXL")
                    {
                        $soldout->xxl_sold = (int)$item['quantity'];
    
                    }
                    //$soldout->rating = "";
                    $soldout->currency = "Taka";

                    if(($item['currency']=="Taka")||($item['currency']=="TK."))
                    {
                        $soldout->price = (int)$item['price'];
                        $soldout->cost = (int)$item['cost'];
                        $soldout->profit = $totalprice - $totalcost;
                        $soldout->profit = $soldout->price - $soldout->cost;

                    }else if(($item['currency']=="Rupee")||($item['currency']=="RS."))
                    {
                        $soldout->price = (int)$item['price'] * 1.5;
                        $soldout->cost = (int)$item['cost'] * 1.5;
                        //$soldout->profit = ($totalprice - $totalcost) * 1.5;
                        $soldout->profit = $soldout->price - $soldout->cost;

                    }else if($item['currency']=="$")
                    {
                        $soldout->price = (int)$item['price'] * 82.71;
                        $soldout->cost = (int)$item['cost'] * 82.71;
                        //$soldout->profit = ($totalprice - $totalcost) * 82.71;
                        $soldout->profit = $soldout->price - $soldout->cost;

                    }else if($item['currency']=="Euro")
                    {
                        $soldout->price = (int)$item['price'] * 94.91;
                        $soldout->cost = (int)$item['cost'] * 94.91;
                        //$soldout->profit = ($totalprice - $totalcost) * 94.91;
                        $soldout->profit = $soldout->price - $soldout->cost;
                    }
                    
                    $soldout->offer = (int)$item['offer'];
                    //$soldout->image = "";
                    $soldout->save();

                }else{
                    $soldout[0]->pname = $item['pname'];
                    $soldout[0]->category = $item['category'];
                    $soldout[0]->pfor = $item['pfor'];
                    //$soldout[0]->size = $size;
                    $soldout[0]->sold += (int)$item['quantity'];
                    if($size=="XS")
                    {
                        $soldout[0]->xs_sold += (int)$item['quantity'];
    
                    }else if($size=="S")
                    {
                        $soldout[0]->s_sold += (int)$item['quantity'];
    
                    }else if($size=="M")
                    {
                        $soldout[0]->m_sold += (int)$item['quantity'];
    
                    }else if($size=="L")
                    {
                        $soldout[0]->l_sold += (int)$item['quantity'];
    
                    }else if($size=="XL")
                    {
                        $soldout[0]->xl_sold += (int)$item['quantity'];
    
                    }else if($size=="XXL")
                    {
                        $soldout[0]->xxl_sold += (int)$item['quantity'];
    
                    }
                    //$soldout[0]->rating = "";
                    //$soldout[0]->currency = "Taka";

                    if(($item['currency']=="Taka")||($item['currency']=="TK."))
                    {
                        $soldout[0]->price = (int)$item['price'];
                        $soldout[0]->cost = (int)$item['cost'];
                        //$soldout[0]->profit += $totalprice - $totalcost;
                        $soldout[0]->profit += $soldout[0]->price - $soldout[0]->cost;

                    }else if(($item['currency']=="Rupee")||($item['currency']=="RS."))
                    {
                        $soldout[0]->price = (int)$item['price'] * 1.5;
                        $soldout[0]->cost = (int)$item['cost'] * 1.5;
                        //$soldout[0]->profit += ($totalprice - $totalcost) * 1.5;
                        $soldout[0]->profit += $soldout[0]->price - $soldout[0]->cost;

                    }else if($item['currency']=="$")
                    {
                        $soldout[0]->price = (int)$item['price'] * 82.71;
                        $soldout[0]->cost = (int)$item['cost'] * 82.71;
                        //$soldout[0]->profit += ($totalprice - $totalcost) * 82.71;
                        $soldout[0]->profit += $soldout[0]->price - $soldout[0]->cost;

                    }else if($item['currency']=="Euro")
                    {
                        $soldout[0]->price = (int)$item['price'] * 94.91;
                        $soldout[0]->cost = (int)$item['cost'] * 94.91;
                        //$soldout[0]->profit += ($totalprice - $totalcost) * 94.91;
                        $soldout[0]->profit += $soldout[0]->price - $soldout[0]->cost;
                    }

                    $soldout[0]->offer = (int)$item['offer'];
                    //$soldout[0]->image = "";
                    $soldout[0]->save();

                }
                
                $pid = (int)$item['pid'];
                $product = Product::find($pid);
                if($size=="XS")
                {
                    $product->xs_available -= (int)$item['quantity'];

                }else if($size=="S")
                {
                    $product->s_available -= (int)$item['quantity'];

                }else if($size=="M")
                {
                    $product->m_available -= (int)$item['quantity'];

                }else if($size=="L")
                {
                    $product->l_available -= (int)$item['quantity'];

                }else if($size=="XL")
                {
                    $product->xl_available -= (int)$item['quantity'];

                }else if($size=="XXL")
                {
                    $product->xxl_available -= (int)$item['quantity'];

                }
                $product->available -= (int)$item['quantity'];
                $nowAvailable = $product->available;
                $product->save();

                //Send Product Quantity empty notification
                if($nowAvailable <= 0)
                {
                    $date = Carbon::now('Asia/Dhaka');
                    $notify_date = $date->toFormattedDateString();
                    $notify_time = $date->toTimeString();

                    $notification = new Notification;
                    $notification->notify_for = "Product";
                    $notification->notify_forid = (int)$item['pid'];
                    $notification->notify_of = "Product";
                    $notification->notify_ofid = (int)$item['pid'];
                    $notification->notify_type = "StockOut";
                    $notification->notify_by = "System";
                    $notification->notify_title = "Out of Stock";
                    $notification->notify_dtls = "Product '".$item['pname']."' is out of Stock!";
                    $notification->notify_to = "Admin";
                    $notification->notify_time = $notify_time;
                    $notification->notify_date = $notify_date;
                    $notification->status = "unchecked";
                    $notification->pid = (int)$item['pid'];
                    $notification->save();
                }
            }

            Session::forget('cartitems');
            return redirect('/')->with('message', 'Purchase Successful!');

        }else{

            return redirect('/');
        }
        
    }

}
