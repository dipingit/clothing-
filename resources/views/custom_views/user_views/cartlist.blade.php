<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">-->
  <title>Clothing -> CartList</title>

  <!-- Laravel core CSS -->
  <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->

  <!-- Bootstrap core CSS-->
  <link href="{{asset('custom_public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('custom_public/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('custom_public/css/sb-admin.css')}}" rel="stylesheet">
      <style>
        body {
            background: url(custom_public/images/3.jpg) no-repeat 0px 0px;
            background-size: cover;
            font-family: "Roboto", sans-serif;
        }

    </style>
</head>

<body class="bg-dark">

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/"> Clothing </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item dropdown active">
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

  <div class="container">
    <div class="card card-register mx-auto mt-5 pt-md-2" style="max-width: 100%;">
      <div class="card-header"><strong>Cart List Items</strong></div>
      <div class="card-body">
        @if($allCartItems)
        <form method="post" action="/checkout" enctype="multipart/form-data" id="register">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="form-group">
            <div class="form-row">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <th>Size</th>
                      <th>Quantiy</th>
                      <th>Price / unit</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                    $i=1;
                    $nettotal=0;
                  @endphp
                  @foreach ($allCartItems as $Item)
                  @php
                    if(($Item["currency"]=="Rupee")||($Item["currency"]=="RS."))
                    {
                      $nettotal += $Item["total"]*1.5;  
                    }else if(($Item["currency"]=="Taka")||($Item["currency"]=="TK."))
                    {
                      $nettotal += $Item["total"];  
                    }else if($Item["currency"]=="$")
                    {
                      $nettotal += $Item["total"]*82.71;  
                    }else if($Item["currency"]=="Euro")
                    {
                      $nettotal += $Item["total"]*94.91;  
                    } 
                  @endphp
                    <tr id="{{$i}}">
                      <input type="hidden" name="price" value="{{$Item["price"]}}"/>
                      <input type="hidden" name="currency" value="{{$Item["currency"]}}"/>
                      <input type="hidden" name="squantity" value="{{$Item["quantity"]}}"/>
                      <td>@php echo $i++; @endphp</td>
                      <td>{{$Item["pname"]}}</td>
                      <td>{{$Item["quantityFor"]}}</td>
                      @if($Item["quantityFor"]=="XS")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["xsavailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @elseif($Item["quantityFor"]=="S")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["savailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @elseif($Item["quantityFor"]=="M")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["mavailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @elseif($Item["quantityFor"]=="L")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["lavailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @elseif($Item["quantityFor"]=="XL")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["xlavailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @elseif($Item["quantityFor"]=="XXL")
                      <td><input type="number" name="quantity" min="1" max="{{$Item["xxlavailable"]}}" value="{{$Item["quantity"]}}"></td>
                      @endif
                      <td>{{$Item["price"]}} {{$Item["currency"]}}</td>
                      <td class="price">{{$Item["total"]}} {{$Item["currency"]}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <input type="hidden" name="totalprice" value="{{$nettotal}}"/>
                <input type="hidden" name="pid" value="{{$Item["pid"]}}"/>
                <select class="pull-right ml-2" id="cng_currency" name="cng_currency">
                  <option value="Taka"> Taka</option>
                  <option value="$"> $</option>
                  <option value="Rupee"> Rupee</option>
                  <option value="Euro"> Euro</option>
                </select>
                <span class="pull-right text-danger" id="totalprice"><strong> Over all Price : {{$nettotal}} </span></strong>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <label for="purchase-method">Purchase Method :</label>
                  <select class="form-control" id="purchase-method" name="purchase-method">
                    <option value="Home Delivary">Home Delivary</option>
                    <option value="Bikash">Bikash</option>
                    <option value="Rocket">Rocket</option>
                  </select>
              </div>
              <div class="col-md-4">
                <label for="pnumber">Phone Number</label>
                @if((Session::get('phone')!="")||(Session::get('phone')!=null))
                <input class="form-control" id="pnumber" type="text" aria-describedby="phoneHelp" placeholder="Enter phone number" name="pnumber" value="{{ Session::get('phone')}}" required>
                @else
                <input class="form-control" id="pnumber" type="text" aria-describedby="phoneHelp" placeholder="Enter phone number" name="pnumber" required>
                @endif
                <small id="pnumberHelp" class="text-danger" value="<%= pnumber %>"></small>
              </div>
              <div class="col-md-4">
                <label for="address">Address</label>
                @if((Session::get('address')!="")||(Session::get('address')!=null))
                <input class="form-control" id="address" type="text" placeholder="i.e: House# 7, Road No# 1, Block# B, Niketon" name="address" value="{{ Session::get('address')}}" required>
                @else
                <input class="form-control" id="address" type="text" placeholder="i.e: House# 7, Road No# 1, Block# B, Niketon" name="address" required>
                @endif
                <small id="addressHelp" class="text-danger" value="<%= address %>"></small>
              </div>
            </div>
          </div>
          <!--<a class="btn btn-primary btn-block" href="/registration">Register</a>-->
          <div class="form-group">
            <div class="form-row">
              <div class="btn-group col-md-12">
                <a class="btn btn-danger col-md-6" href="/">Cancel</a>
                <input class="btn btn-primary col-md-6" type="submit" value="Check Out" />
              </div>
            </div>
          </div>
        </form>
        @else
        <div class="jumbotron" >
          <img class="rounded mx-auto d-block" src="custom_public/images/emptycart.png" alt=""><h1 class="text-center text-muted"> <strong>Cart is Empty!!</strong> </h1>
        </div>
        @endif
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('custom_public/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('custom_public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('custom_public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom plugin JavaScript-->
  <script src="{{asset('custom_public/cartlist.js')}}"></script>
</body>

</html>
