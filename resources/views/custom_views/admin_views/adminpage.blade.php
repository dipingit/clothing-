<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>C&S Clothing Admin</title>
  <!-- Laravel core CSS -->
    <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->

  <!-- Bootstrap core CSS-->
  <link href="{{asset('custom_public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material icon core CSS-->
  <link href="{{asset('custom_public/vendor/mdi/css/materialdesignicons.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('custom_public/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{asset('custom_public/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('custom_public/css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/admin">EShop Clothing</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="/admin">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Welcome {{ Session::get('admin')}}</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a class="nav-link" href="/admin/usertable">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">User Table</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="/admin">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Product Table</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="/admin/purchasetable">
                  <i class="fa fa-fw fa-sitemap"></i>
                  <span class="nav-link-text">Purchase Table</span>
                  </a>
              </li>
              <li>
                <a class="nav-link" href="/admin/messagetable">
                  <i class="fa fa-fw fa-sitemap"></i>
                  <span class="nav-link-text">Message Table</span>
                </a>
             </li>
            <!--<li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>-->
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="max-height: 350px; margin-bottom: 10px;
          overflow:scroll;">
            <h6 class="dropdown-header">New Alerts:</h6>
            @if($notifications!=null)
            @foreach($notifications as $notify)
            @if($notify->notify_to=="Admin")
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cloth/{{$notify->notify_forid}}">
              <span class="text-warning">
                <strong>
                  <i class="fa fa-warning"></i> <span class="small float-right text-muted">{{$notify->notify_time}} | {{$notify->notify_date}}</span>
                  <p>{{$notify->notify_title}}</p>
                </strong>
              </span>
              {{-- <div class="dropdown-message small">{{$notify->notify_dtls}}</div> --}}
            </a>
            <div class="container-fluid small">{{$notify->notify_dtls}}</div>
            @endif
            @endforeach
            @endif
            <div class="dropdown-divider"></div>
            {{-- <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a> --}}
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for..." id="nam" />
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="search">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
      @if(session()->has('message'))
      <div class="alert alert-success text-center" id="msgdiv">
          <strong>{{ session()->get('message') }}</strong>
      </div>
      @endif
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">{{ Session::get('admin')}}</a>
        </li>
        <li class="breadcrumb-item active">Product Tables</li>
      </ol>

      <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left" style="font-size:50px;">
                  <i class="mdi mdi-cube text-danger icon-lg"></i>
                </div>
                <div class="float-right">
                  <p class="mb-0 text-right">Total Revenue</p>
                  <div class="fluid-container">
                    <h5 class="font-weight-medium text-right mb-0">{{$allRecords->totalPrice - $allRecords->totalCost}} TK.</h5>
                      <p class="text-muted small mt-3 mb-0"> Investment : {{($allRecords->totalQuantity + $allRecords->totalSales)*$allRecords->totalCost}} TK.
                      </p>
                  </div>
                </div>
              </div>
              <p class="text-muted small mt-3 mb-0">
                <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Costs : {{$allRecords->totalCost}} | Earning : {{$allRecords->totalPrice}}
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left" style="font-size:50px;">
                  <i class="mdi mdi-receipt text-warning icon-lg"></i>
                </div>
                <div class="float-right">
                  <p class="mb-0 text-right">Products</p>
                  <div class="fluid-container">
                    <h5 class="font-weight-medium text-right mb-0">{{$allRecords->totalProducts}}</h5>
                  </div>
                </div>
              </div>
              <p class="text-muted mt-3 mb-0">
                <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Quantity : {{$allRecords->totalQuantity}} 
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left" style="font-size:50px;">
                  <i class="mdi mdi-poll-box text-success icon-lg"></i>
                </div>
                <div class="float-right">
                  <p class="mb-0 text-right">Sales</p>
                  <div class="fluid-container">
                    <h5 class="font-weight-medium text-right mb-0">{{$allRecords->totalSales}}</h5>
                  </div>
                </div>
              </div>
              <p class="text-muted mt-3 mb-0">
                <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total Sales
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left" style="font-size:50px;">
                  <i class="mdi mdi-account-location text-info icon-lg"></i>
                </div>
                <div class="float-right">
                  <p class="mb-0 text-right">Registered Users</p>
                  <div class="fluid-container">
                    <h5 class="font-weight-medium text-right mb-0">{{$allRecords->totalCustomers}}</h5>
                  </div>
                </div>
              </div>
              <p class="text-muted mt-3 mb-0">
                <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Admin : {{$allRecords->totalAdmins}} 
              </p>
            </div>
          </div>
        </div>

      </div>

      <!-- Example DataTables Card-->
      <div class="card mb-3 mt-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table of Product </div>
          <a class="btn btn-success btn-md pull-right" href="/admin/addproduct">Add Product</a>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col">All Operations</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product For</th>
                  <th scope="col">Product Category</th>
                  <th scope="col">Available Quantity</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Manufecture Cost</th>
                  <th scope="col">Product Offer</th>
                  <th scope="col">Product Rating</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                <th scope="col">All Operations</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product For</th>
                <th scope="col">Product Category</th>
                <th scope="col">Available Quantity</th>
                <th scope="col">Product Price</th>
                <th scope="col">Manufecture Cost</th>
                <th scope="col">Product Offer</th>
                <th scope="col">Product Rating</th>
                </tr>
              </tfoot>
              <tbody>
              {{-- <% for(var i=0;i<list.length;i++){%> --}}
              @foreach ($allProducts as $product )
                <tr>
                  <td scope="row">
                    <div class="btn-group btn-group-justified">
                    <a class="btn btn-secondary btn-sm" href="/cloth/{{$product->pid}}">More</a>
                    <a class="ml-1 btn btn-success btn-sm" href="/admin/updateproduct/{{$product->pid}}">Update</a>
                    <form action="/admin/deleteproduct/{{$product->pid}}" method="post" id="delete-product">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <button type="button" class="btn btn-danger btn-sm dropdown-toggle ml-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
                        <div class="dropdown-menu">
                          <input class="dropdown-item" type="submit" value="Yes" name="yes"/>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">No</a>
                          <input type="hidden" value="{{$product->pname}}" name="productname"/>
                        </div>
                    </form>
                    </div>
                  </td>
                  <td>{{$product->pname}}</td>
                  <td>{{$product->pfor}}</td>
                  <td>{{$product->category}}</td>
                  <td>
                    <p>Available: {{$product->available}},</p>
                    <p>XS : {{$product->xs_available}}, S : {{$product->s_available}}, </p>
                    <p>M : {{$product->m_available}},  L : {{$product->l_available}},</p>
                    <p>XL : {{$product->xl_available}}, XXL : {{$product->xxl_available}}</p>
                  </td>
                  <td>{{$product->price}} {{$product->currency}}</td>
                  <td>{{$product->cost}} {{$product->currency}}</td>
                  <td>{{$product->offer}} %</td>
                  <td>{{$product->rating}}</td>
                  
                </tr>
                @endforeach
              {{-- <% } %> --}}
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © EShop Cloth Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('custom_public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('custom_public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('custom_public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('custom_public/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('custom_public/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('custom_public/js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{asset('custom_public/js/sb-admin-datatables.min.js')}}"></script>
    <script type="text/javascript">
      setTimeout(function() {
          $('#msgdiv').fadeOut('slow'); //fast
      }, 5000);
    </script>
  </div>
</body>

</html>
