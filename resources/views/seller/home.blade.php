<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Seller</title>

  <!-- Custom fonts for this template-->
  <link href="/seller/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="/seller/bootstrap/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="/seller/css/seller.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Seller</a>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">notifications</a>
          
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
        <a class="dropdown-item" href="#">Check Your Mail</a>
          <a class="dropdown-item" href="#">Check Office Mail</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Open New Mail account</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::user()->username}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{route('managerProfile.edit')}}">Edit Profile</a>
          <a class="dropdown-item" href="{{route('managerProfile.settings')}}">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">


    <div id="content-wrapper" style="background:-webkit-repeating-linear-gradient(90deg,white,violet,white)">
      <div class="container-fluid col-sm-10 offset-sm-1">
      <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
          </ol>
  

     

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<section class="after-loop">
  <div class="container">
  <div class="row">
  <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
  <a href="/seller/invoice" class="card text-white bg-primary o-hidden  after-loop-item card border-0 card-templates shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>Place an Order</h4>
  <p class="w-75">[Click to order] </br> Make a n Invoice and Print a recipt </p>
  <div class="card-body-icon">
      <i class="fas fa-file-invoice-dollar"></i>
  </div>

  </div>
  </a>
  </div>
  <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
  <a href="/seller/food-items" class="card text-white bg-warning o-hidden after-loop-item card border-0 card-snippets shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>View Food Items</h4>
  <p class="w-75">[Click to view] </br> All available food items are here [Search] </p>
  <div class="card-body-icon">
        <i class="fas fa-pizza-slice"></i>
  </div>

  </div>
  </a>
  </div>
  <div class="col-lg-4 col-md-8 mx-auto">
  <a href="/seller/inventory" class="card text-white bg-success o-hidden after-loop-item card border-0 card-guides shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>View Inventory</h4>
  <p class="w-75">[Click to view] </br> All Raw goods & food ingredients are here [Catagory] </p>
    <div class="card-body-icon">
    <i class="fas fa-fw fa-shopping-cart"></i>
    </div>
  </div>
  </a>
  </div>
  
  <div class="col-lg-4 col-md-8 mx-auto" style="margin-top:1em;" >
  <a href="/seller/order-status" target="_blank"  class="card text-white bg-success o-hidden after-loop-item card border-0 card-guides shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>Order Status</h4>
  <p class="w-75">[Click to view] </br>All Pending Orders are here. Click to see the pending orders</p>
    <div class="card-body-icon">
    <i class="fas fa-business-time"></i>
    </div>
  </div>
  </a>
  </div>

  <div class="col-lg-4 col-md-8 mx-auto" style="margin-top:1em;" >
  <a href="/seller/insert-raw-goods" class="card text-white bg-danger o-hidden after-loop-item card border-0 card-guides shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>Raw Goods Data Entry</h4>
  <p class="w-75">[Click to Visit] </br> Data entry point of all Raw Goods</p>
    <div class="card-body-icon">
    <i class="fas fa-cart-arrow-down"></i>
    </div>
  </div>
  </a>
  </div>

  <div class="col-lg-4 col-md-8 mx-auto" style="margin-top:1em;" >
  <a href="/seller/packed-food-ingredient" class="card text-white bg-primary o-hidden after-loop-item card border-0 card-guides shadow-lg">
  <div class="card-body d-flex align-items-end flex-column text-right">
  <h4>Packed Food Ingredient Data Entry</h4>
  <p class="w-75">Data entry point of all Raw Goods</p>
    <div class="card-body-icon">
    <i class="fas fa-wine-bottle"></i>
    <i class="fas fa-cheese"></i>

    </div>
  </div>
  </a>
  </div>

  
</select>

  <!-- Bootstrap core JavaScript-->
  <script src="/custom/vendor/jquery/jquery.min.js"></script>
  <script src="/custom/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/custom/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="/custom/vendor/chart.js/Chart.min.js"></script>
  <script src="/custom/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/custom/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/custom/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/custom/js/demo/datatables-demo.js"></script>
  <script src="/custom/js/demo/chart-area-demo.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/custom/js/demo/chart-area-demo.js"></script>
  <script src="/custom/js/demo/chart-bar-demo.js"></script>
  <script src="/custom/js/demo/chart-pie-demo.js"></script>

</body>

</html>
