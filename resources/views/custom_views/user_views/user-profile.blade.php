


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
  <!-- Laravel core CSS -->
  <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->

  <!-- Bootstrap core CSS -->
  <link href="{{asset('custom_public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{asset('custom_public/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container position-relative">
            <a class="navbar-brand" href="/"> Clothing </a>
            <a class="nav-link" href="/cartlist" id="carticon">
                <i class="fa fa-shopping-cart shopping-cart" style="font-size:24px;color:white"></i>
                <span class="text-white" id="cartitem"></span>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clothes & Dresses
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                    <a class="dropdown-item" href="/allclothings">All Clothings</a>
                    <a class="dropdown-item" href="/mensclothing">Men's Clothing</a>
                    <a class="dropdown-item" href="/womensclothing">Women's Clothing</a>
                    <a class="dropdown-item" href="/childsclothing">Child's Clothing</a>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/services">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/contact">Contact Us</a>
                </li>
                @if(Session::has('admin'))
                <li class="nav-item">
                <a class="nav-link" href="/admin">{{ Session::get('user')}}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/logout">logout</a>
                </li>
                @elseif(Session::has('user'))
                <li class="nav-item">
                <a class="nav-link" href="/user-profile">{{ Session::get('user')}}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/logout">logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                @endif
            </ul>
            </div>
        </div>
        </nav>

    <div class="container" style="padding-top: 70px;">
        @if(session()->has('message'))
        <div class="alert alert-success text-center mzs-alert-div" id="msgdiv">
            <strong>{{ session()->get('message') }}</strong>
        </div>
        @endif
        @if($errors->has('uploadErr'))
        <div class="alert alert-danger text-center mzs-alert-div" id="errpic" role="alert">
            <strong>{{ $errors->first('uploadErr') }}</strong>
        </div>
        @endif
        @if($errors->has('updateErr'))
        <div class="alert alert-danger text-center mzs-alert-div" id="errdiv" role="alert">
            <strong>{{ $errors->first('updateErr') }}</strong>
        </div>
        @endif
        @if(!empty($errors->first()))
        <div class="alert alert-danger text-center mzs-alert-div" id="errsdiv" role="alert">
            <strong>{{ $errors->first() }}</strong>
        </div>
            {{-- <div class="row col-lg-12">
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            </div> --}}
        @endif
        <div class="row my-2">
            <div class="col-lg-8 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#purchases" data-toggle="tab" class="nav-link">My Purchases</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#favourites" data-toggle="tab" class="nav-link">My Favourites</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit Info</a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h5 class="text-capitalize mb-3">{{$user[0]->username}}'s Profile</h5>
                        <div class="row">
                            <div class="col-md-6 text-capitalize">
                                
                                <h6>About</h6>
                                <p>
                                    Full Name : {{$user[0]->firstname}} {{$user[0]->lastname}}
                                </p>
                                <p>
                                    Gender : {{$user[0]->gender}}
                                </p>
                                <p>
                                    Date of Birth : {{$user[0]->dob}}
                                </p>
                                <p>
                                    Email : {{$user[0]->email}}
                                </p>
                                <p>
                                    Phone Number : {{$user[0]->phonenumber}}
                                </p>
                                <p>
                                    Address : {{$user[0]->country}}, {{$user[0]->city}}, {{$user[0]->area}}, {{$user[0]->address}}
                                </p>
                                {{-- <h6>Hobbies</h6>
                                <p>
                                    Indie music, skiing and hiking. I love the great outdoors.
                                </p> --}}
                            </div>
                            <div class="col-md-6">
                                <h6>Recent badges</h6>
                                <a href="#" class="badge badge-dark badge-pill">html5</a>
                                <a href="#" class="badge badge-dark badge-pill">react</a>
                                <a href="#" class="badge badge-dark badge-pill">codeply</a>
                                <a href="#" class="badge badge-dark badge-pill">angularjs</a>
                                <a href="#" class="badge badge-dark badge-pill">css3</a>
                                <a href="#" class="badge badge-dark badge-pill">jquery</a>
                                <a href="#" class="badge badge-dark badge-pill">bootstrap</a>
                                <a href="#" class="badge badge-dark badge-pill">responsive-design</a>
                                <hr>
                                <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                                <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                            </div>
                            <div class="col-md-12">
                                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                <table class="table table-sm table-hover table-striped">
                                    <tbody>                                    
                                        <tr>
                                            <td>
                                                <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        <div class="alert alert-info alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
                        </div>
                        <table class="table table-hover table-striped">
                            <tbody>                                    
                                <tr>
                                    <td>
                                       <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
                                    </td>
                                </tr>
                            </tbody> 
                        </table>
                    </div>
                    <div class="tab-pane" id="purchases">
                        <div class="row">
                            @foreach ($allPurchases as $product )
                              {{-- <div class="col-lg-4 col-sm-6 portfolio-item" > --}}
                              <div class="col-lg-6 col-sm-6 portfolio-item mb-3" id="{{$product->pid}}">
                                <input type="hidden" name="pid" value="{{$product->pid}}"/>
                                <input type="hidden" name="pname" value="{{$product->pname}}"/>
                                <input type="hidden" name="pfor" value="{{$product->pfor}}"/>
                                <input type="hidden" name="category" value="{{$product->category}}"/>
                                <input type="hidden" name="size" value="{{$product->size}}"/>
                                <input type="hidden" name="available" value="{{$product->available}}"/>
                                <input type="hidden" name="qavailable" value="{{$product->available}}"/>
                                <input type="hidden" name="xsavailable" value="{{$product->xs_available}}"/>
                                <input type="hidden" name="savailable" value="{{$product->s_available}}"/>
                                <input type="hidden" name="mavailable" value="{{$product->m_available}}"/>
                                <input type="hidden" name="lavailable" value="{{$product->l_available}}"/>
                                <input type="hidden" name="xlavailable" value="{{$product->xl_available}}"/>
                                <input type="hidden" name="xxlavailable" value="{{$product->xxl_available}}"/>
                                @if(($product->offer==0)||($product->offer==null))
                                <input type="hidden" name="price" value="{{$product->price}}"/>
                                @else
                                  @php 
                                  $discount = ($product->price * $product->offer)/100;
                                  $newprice = $product->price - $discount;
                                  @endphp
                                  <input type="hidden" name="price" value="{{$newprice}}"/>
                                @endif
                                <input type="hidden" name="cost" value="{{$product->cost}}"/>
                                <input type="hidden" name="currency" value="{{$product->currency}}"/>
                                <input type="hidden" name="offer" value="{{$product->offer}}"/>
                                <div class="card h-100 item">
                                  <a href="/cloth/{{$product->pid}}"><img class="card-img-top" src="custom_public/uploads/products/{{$product->pname}}/images/{{$product->pname}}0.jpg" onerror="this.src = 'custom_public/images/products.jpg'" alt=""></a>
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a href="/cloth/{{$product->pid}}">{{$product->pname}}</a>
                                        </h4>
                                        <span>Purchase Date : {{$product->date}}</span>
                                        <span class="pull-right">Quantity : {{$product->quantity}}</span>
                                        Product Size : {{$product->size}}
                                        <p>Price per Item  : {{$product->price}} {{$product->currency}}</p>
                                        <span>Total Price : {{$product->totalprice}} {{$product->currency}}</span>
                                    </div>
                                    <div class="card-body">
                                    <h5><div class="product-rating">
                                      {{-- floor(0.60) --}}
                                      @if(floor($product->rating)>0)
                                        @for($i = 1; $i<=floor($product->rating); $i++)
                                          <span class="fa fa-star" data-rating="{{$i}}"></span>
                                        @endfor
                                        @for($i = floor($product->rating); $i<5; $i++)
                                          <span class="fa fa-star-o" data-rating="{{$i+1}}"></span>
                                        @endfor
                                        <span class="ml-2">{{round($product->rating,2)}}</span>
                                      @endif
                                      
                                      @if(($product->rating==0)||($product->rating==null))
                                        <input type="hidden" name="rating" class="rating-value" value="0">
                                      @else
                                        <input type="hidden" name="rating" class="rating-value" value="{{$product->rating}}">
                                      @endif
                                    </div></h5>
                                    @if(($product->offer==0)||($product->offer==null))
                                    <h5>{{$product->price}} {{$product->currency}}</h5>
                                    @else
                                    <h5><strike>{{$product->price}} {{$product->currency}}</strike> <span class="ml-1">{{$newprice}} {{$product->currency}}</span><span class="pull-right text-danger">{{$product->offer}}% off</span></h5>
                                    @endif
                                    <p class="card-text">
                                      Product For : {{$product->pfor}} </br>
                                      Product Category :  {{$product->category}} </br>
                                      Product Price :  {{$product->price}} {{$product->currency}} </br>
                                    </p>
                                    
                                  </div>
                                  {{-- <% if(username!=""){%> --}}
                                  <div class="card-footer">
                                    <h6> Give Rating : 
                                      <div class="star-rating pull-right" style="cursor: pointer">
                                        <span class="fa fa-star-o" data-rating="1"></span>
                                        <span class="fa fa-star-o" data-rating="2"></span>
                                        <span class="fa fa-star-o" data-rating="3"></span>
                                        <span class="fa fa-star-o" data-rating="4"></span>
                                        <span class="fa fa-star-o" data-rating="5"></span>
                                        @php
                                         $found = false;   
                                        @endphp
                                        @foreach($ratings as $rating)
                                          @if($rating->pid==$product->pid)
                                            <input type="hidden" name="rating" class="rating-value" value="{{$rating->rating}}">
                                            @php
                                              $found = true; 
                                            @endphp
                                            @break
                                          @endif
                                        @endforeach
                                        @if($found == false)
                                          <input type="hidden" name="rating" class="rating-value" value="0">
                                        @endif
                                      </div>
                                    </h6>
                                  </div>
                                  <div class="card-footer">
                                    <button type="button" class="btn btn-success btn-sm mzs-atc">Add to Cart</button>
                                    <select class="allsizes" name="allsizes">
                                      <option value="{{$product->available}}">Size</option>
                                      @if(($product->xs_available!=null)||($product->xs_available!=0))
                                      <option value="{{$product->xs_available}}">XS</option>
                                      @endif
                                      @if(($product->s_available!=null)||($product->s_available!=0))
                                      <option value="{{$product->s_available}}">S</option>
                                      @endif
                                      @if(($product->m_available!=null)||($product->m_available!=0))
                                      <option value="{{$product->m_available}}">M</option>
                                      @endif
                                      @if(($product->l_available!=null)||($product->l_available!=0))
                                      <option value="{{$product->l_available}}">L</option>
                                      @endif
                                      @if(($product->xl_available!=null)||($product->xl_available!=0))
                                      <option value="{{$product->xl_available}}">XL</option>
                                      @endif
                                      @if(($product->xxl_available!=null)||($product->xxl_available!=0))
                                      <option value="{{$product->xxl_available}}">XXL</option>
                                      @endif
                                    </select>
                                    <input class="quantity" type="number" name="quantity" min="1" max="{{$product->available}}" value="1">
                                    @php
                                      $found = false;   
                                    @endphp
                                    @foreach($favourites as $favourite)
                                      @if($favourite->pid==$product->pid)
                                        <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Added as favourite"><i class="fa fa-heart mzs-atf" style="font-size:24px"></i></button>
                                        @php
                                          $found = true; 
                                        @endphp
                                        @break
                                      @endif
                                    @endforeach
                                    @if($found == false)
                                      <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Add to favourite"><i class="fa fa-heart-o mzs-atf" style="font-size:24px"></i></button>
                                    @endif
                      
                                    {{-- <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Add to favourite"><i class="fa fa-heart-o mzs-atf" style="font-size:24px"></i></button> --}}
                      
                                    {{-- <i class="fa fa-heart" style="font-size:24px"></i> --}}
                      
                                  </div>
                                  {{-- <% } %> --}}
                                </div>
                              </div>
                              @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="favourites">
                        <div class="row">
                        @foreach ($allFavourites as $product )
                        @if($product->available>0)
                            {{-- <div class="col-lg-4 col-sm-6 portfolio-item" > --}}
                            <div class="col-lg-6 col-sm-6 portfolio-item" id="{{$product->pid}}">
                            <input type="hidden" name="pid" value="{{$product->pid}}"/>
                            <input type="hidden" name="pname" value="{{$product->pname}}"/>
                            <input type="hidden" name="pfor" value="{{$product->pfor}}"/>
                            <input type="hidden" name="category" value="{{$product->category}}"/>
                            <input type="hidden" name="size" value="{{$product->size}}"/>
                            <input type="hidden" name="available" value="{{$product->available}}"/>
                            <input type="hidden" name="qavailable" value="{{$product->available}}"/>
                            <input type="hidden" name="xsavailable" value="{{$product->xs_available}}"/>
                            <input type="hidden" name="savailable" value="{{$product->s_available}}"/>
                            <input type="hidden" name="mavailable" value="{{$product->m_available}}"/>
                            <input type="hidden" name="lavailable" value="{{$product->l_available}}"/>
                            <input type="hidden" name="xlavailable" value="{{$product->xl_available}}"/>
                            <input type="hidden" name="xxlavailable" value="{{$product->xxl_available}}"/>
                            @if(($product->offer==0)||($product->offer==null))
                            <input type="hidden" name="price" value="{{$product->price}}"/>
                            @else
                                @php 
                                $discount = ($product->price * $product->offer)/100;
                                $newprice = $product->price - $discount;
                                @endphp
                                <input type="hidden" name="price" value="{{$newprice}}"/>
                            @endif
                            <input type="hidden" name="cost" value="{{$product->cost}}"/>
                            <input type="hidden" name="currency" value="{{$product->currency}}"/>
                            <input type="hidden" name="offer" value="{{$product->offer}}"/>
                            <div class="card h-100 item">
                                <a href="/cloth/{{$product->pid}}"><img class="card-img-top" src="custom_public/uploads/products/{{$product->pname}}/images/{{$product->pname}}0.jpg" onerror="this.src = 'custom_public/images/products.jpg'" alt=""></a>
                                <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/cloth/{{$product->pid}}">{{$product->pname}}</a>
                                </h4>
                                <h5><div class="product-rating">
                                    {{-- floor(0.60) --}}
                                    @if(floor($product->rating)>0)
                                    @for($i = 1; $i<=floor($product->rating); $i++)
                                        <span class="fa fa-star" data-rating="{{$i}}"></span>
                                    @endfor
                                    @for($i = floor($product->rating); $i<5; $i++)
                                        <span class="fa fa-star-o" data-rating="{{$i+1}}"></span>
                                    @endfor
                                    <span class="ml-2">{{round($product->rating,2)}}</span>
                                    @endif
                                    
                                    @if(($product->rating==0)||($product->rating==null))
                                    <input type="hidden" name="rating" class="rating-value" value="0">
                                    @else
                                    <input type="hidden" name="rating" class="rating-value" value="{{$product->rating}}">
                                    @endif
                                </div></h5>
                                @if(($product->offer==0)||($product->offer==null))
                                <h5>{{$product->price}} {{$product->currency}}</h5>
                                @else
                                <h5><strike>{{$product->price}} {{$product->currency}}</strike> <span class="ml-1">{{$newprice}} {{$product->currency}}</span><span class="pull-right text-danger">{{$product->offer}}% off</span></h5>
                                @endif
                                <p class="card-text">
                                    Product For : {{$product->pfor}} </br>
                                    Product Category :  {{$product->category}} </br>
                                    Product Price :  {{$product->price}} {{$product->currency}} </br>
                                    Product Size :  {{$product->size}}
                                </p>
                                
                                </div>
                                {{-- <% if(username!=""){%> --}}
                                <div class="card-footer">
                                <h6> Give Rating : 
                                    <div class="star-rating pull-right" style="cursor: pointer">
                                    <span class="fa fa-star-o" data-rating="1"></span>
                                    <span class="fa fa-star-o" data-rating="2"></span>
                                    <span class="fa fa-star-o" data-rating="3"></span>
                                    <span class="fa fa-star-o" data-rating="4"></span>
                                    <span class="fa fa-star-o" data-rating="5"></span>
                                    @php
                                        $found = false;   
                                    @endphp
                                    @foreach($ratings as $rating)
                                        @if($rating->pid==$product->pid)
                                        <input type="hidden" name="rating" class="rating-value" value="{{$rating->rating}}">
                                        @php
                                            $found = true; 
                                        @endphp
                                        @break
                                        @endif
                                    @endforeach
                                    @if($found == false)
                                        <input type="hidden" name="rating" class="rating-value" value="0">
                                    @endif
                                    </div>
                                </h6>
                                </div>
                                <div class="card-footer">
                                <button type="button" class="btn btn-success btn-sm mzs-atc">Add to Cart</button>
                                <select class="allsizes" name="allsizes">
                                    <option value="{{$product->available}}">Size</option>
                                    @if(($product->xs_available!=null)||($product->xs_available!=0))
                                    <option value="{{$product->xs_available}}">XS</option>
                                    @endif
                                    @if(($product->s_available!=null)||($product->s_available!=0))
                                    <option value="{{$product->s_available}}">S</option>
                                    @endif
                                    @if(($product->m_available!=null)||($product->m_available!=0))
                                    <option value="{{$product->m_available}}">M</option>
                                    @endif
                                    @if(($product->l_available!=null)||($product->l_available!=0))
                                    <option value="{{$product->l_available}}">L</option>
                                    @endif
                                    @if(($product->xl_available!=null)||($product->xl_available!=0))
                                    <option value="{{$product->xl_available}}">XL</option>
                                    @endif
                                    @if(($product->xxl_available!=null)||($product->xxl_available!=0))
                                    <option value="{{$product->xxl_available}}">XXL</option>
                                    @endif
                                </select>
                                <input class="quantity" type="number" name="quantity" min="1" max="{{$product->available}}" value="1">
                                @php
                                    $found = false;   
                                @endphp
                                @foreach($favourites as $favourite)
                                    @if($favourite->pid==$product->pid)
                                    <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Added as favourite"><i class="fa fa-heart mzs-atf" style="font-size:24px"></i></button>
                                    @php
                                        $found = true; 
                                    @endphp
                                    @break
                                    @endif
                                @endforeach
                                @if($found == false)
                                    <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Add to favourite"><i class="fa fa-heart-o mzs-atf" style="font-size:24px"></i></button>
                                @endif
                    
                                {{-- <button type="button" class="btn btn-light pull-right text-danger love" data-toggle="tooltip" data-placement="bottom" title="Add to favourite"><i class="fa fa-heart-o mzs-atf" style="font-size:24px"></i></button> --}}
                    
                                {{-- <i class="fa fa-heart" style="font-size:24px"></i> --}}
                    
                                </div>
                                {{-- <% } %> --}}
                            </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="edit">
                        <form method="post" action="/user/update-info/{{$user[0]->id}}" enctype="multipart/form-data" id="register">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-12">
                                    <label for="username">{{$user[0]->accounttype}}name</label>
                                    <input class="form-control" id="username" type="text" aria-describedby="nameHelp" placeholder="Enter Username" name="username" value="{{$user[0]->username}}">
                                    @if($errors->has('userEXT'))
                                    <small id="userEXT" class="text-danger">{{ $errors->first('userEXT') }}</small>
                                    @endif
                                    <small id="usernameHelp" class="text-danger"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="firstname">First name</label>
                                    <input class="form-control" id="firstname" type="text" aria-describedby="nameHelp" placeholder="Enter first name" name="firstname" value="{{$user[0]->firstname}}">
                                    <small id="firstnameHelp" class="text-danger"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="lastname">Last name</label>
                                    <input class="form-control" id="lastname" type="text" aria-describedby="nameHelp" placeholder="Enter last name" name="lastname" value="{{$user[0]->lastname}}">
                                    <small id="lastnameHelp" class="text-danger"></small>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="gender">Gender:</label>
                                    <select class="form-control" id="gender" name="gender">
                                        {{$user[0]->accounttype}}
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="DOB">Date of Birth</label>
                                    <input class="form-control" id="DOB" type="date" placeholder="Your Birth Date" name="DOB" value="{{$user[0]->dob}}">
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="email">Email address</label>
                                    <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{$user[0]->email}}">
                                    @if($errors->has('emailEXT'))
                                    <small id="emailEXT" class="text-danger">{{ $errors->first('emailEXT') }}</small>
                                    @endif
                                    <small id="emailHelp" class="text-danger"></small>
                                </div>
                                <div class="col-md-6">
                                    <label for="pnumber">Phone Number</label>
                                    <input class="form-control" id="pnumber" type="text" aria-describedby="phoneHelp" placeholder="Enter phone number" name="pnumber" value="{{$user[0]->phonenumber}}">
                                    <small id="pnumberHelp" class="text-danger"></small>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" type="password" placeholder="Password"  name="password" value="{{$user[0]->password}}">
                                    <small id="passwordHelp" class="text-danger"></small>
                                </div>
                                <div class="col-md-6">
                                    <label for="cpassword">Confirm password</label>
                                    <input class="form-control" id="cpassword" type="password" placeholder="Confirm password" name="cpassword" value="{{$user[0]->password}}">
                                    <small id="cpasswordHelp" class="text-danger"></small>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <select class="form-control" id="country" name="country">
                                    <option value="{{$user[0]->country}}">{{$user[0]->country}}</option>
                                    <option value="Other">Other</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="India">India</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <select class="form-control" id="city" name="city">
                                    <option value="{{$user[0]->city}}">{{$user[0]->city}}</option>
                                    <option value="Other">Other</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="area">Area</label>
                                    <select class="form-control" id="area" name="area">
                                    <option value="{{$user[0]->area}}">{{$user[0]->area}}</option>
                                    <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Address</label>
                                    <input class="form-control" id="address" type="text" placeholder="i.e: House# 7, Road No# 1, Block# B, Niketon" name="address" value="{{$user[0]->address}}">
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                <div class="col-md-6">
                                    <label for="profilepic">Profile Pic</label>
                                    <input class="form-control" id="profilepic" type="file" name="profilepic">
                                </div>
                                <small id="profilepicHelp" class="text-danger"></small>
                                </div>
                            </div>
                            <!--<a class="btn btn-primary btn-block" href="/registration">Register</a>-->
                            <input type="hidden" name="acctype" value="{{$user[0]->accounttype}}"/>
                            <input class="btn btn-primary btn-block" type="submit" value="Update Info" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                {{-- <img src="custom_public/images/1.jpg" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                <h6 class="mt-2">@ Username</h6> --}}
                <div class="card mb-2" style="width: 22rem;">
                    <img class="card-img-top" src="/custom_public/uploads/users/{{$user[0]->username}}/profilepic/{{$user[0]->username}}.jpg" onerror="this.src = '/custom_public/images/user.png'" alt="Card image cap">
                    <div class="card-header text-muted">
                        <span class="text-capitalize">{{$user[0]->username}}</span>
                    </div>
                    <div class="card-body">
                      <p class="card-text">{{$user[0]->firstname}} {{$user[0]->lastname}}</p>
                      <p class="card-text">{{$user[0]->email}}</p>
                      <p class="card-text">{{$user[0]->phonenumber}}</p>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <form  action="/user/change-profilepic" method="post" enctype="multipart/form-data" id="update-form">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <input type="submit" class="input-group-text p-2" name="changepic" value="Change Photo">
                                    <div class="custom-file">
                                        <input class="form-control" id="profilepic" type="file" name="profilepic">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Clothing.com 2018</p>
        </div>
    <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('custom_public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('custom_public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}
    "></script>
    <script src="{{asset('custom_public/addtocart.js')}}"></script>
    <script src="{{URL::asset('custom_public/register-validate.js')}}"></script>
    <script type="text/javascript">
        setTimeout(function() {
            $('.mzs-alert-div').fadeOut('slow'); //fast
        }, 5000);
      </script>
</body>
</html>