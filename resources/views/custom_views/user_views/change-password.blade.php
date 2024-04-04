<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">-->
  <title>Clothing -> Registration</title>

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

  <div class="container">
    <div class="card card-register mx-auto mt-5 pt-md-2">
       @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
      <div class="card-header"><strong>Register an Account</strong></div>
      <div class="card-body">
        <form method="POST" action="{{route('user.changepassword' , $user_id)}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="form-row">
             <div class="col-md-12">
                <label for="username">Current Password</label>
                <input class="form-control" type="password" placeholder="Enter Current Password" name="current_password" value="">
                <small id="passwordHelp" class="text-danger"></small>
              </div>
              <div class="col-md-6 mt-3">
                <label for="password">New Password</label>
                <input class="form-control" id="firstname" type="password" placeholder="Enter New Password" name="new_password" value="">
                <small id="passwordHelp" class="text-danger"></small>
              </div>
              <div class="col-md-6 mt-3">
                <label for="cpassword">Confirm password</label>
                <input class="form-control" type="password" placeholder="Confirm New Password" name="confirm_password" value="">
                <small id="cpasswordHelp" class="text-danger"></small>
              </div>
            </div>
          </div>
         
          <!--<a class="btn btn-primary btn-block" href="/registration">Register</a>-->
          <input type="hidden" name="acctype" value="User"/>
          {{-- <input class="btn btn-primary btn-block" type="submit" value="Register" /> --}}
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('custom_public/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('custom_public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('custom_public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom plugin JavaScript-->
  <script src="{{asset('custom_public/register-validate.js')}}"></script>
</body>

</html>
