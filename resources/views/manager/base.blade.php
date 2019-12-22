<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title}}</title>
  <link rel="icon" type="image/gif/png" href="{{asset('/images/download.png')}}">
  @yield('css')

  <!-- Custom fonts for this template-->
  <link href="/custom/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="/custom/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

  <!-- Custom styles for this template-->
  <link href="/custom/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <span class="navbar-brand mr-1" href="index.html">{{$title}}</span>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::user()->username}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{route('managerProfile.edit')}}">Edit Profile</a>
          <a class="dropdown-item" href="{{route('managerProfile.settings')}}">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" style="">
      <li class="nav-item active">
        <a class="nav-link" href="/manager/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-clipboard"></i>
          <span>Attendance</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{route('attendance')}}">Take Attendance</a>
          <a class="dropdown-item" href="{{route('viewAttendance')}}">View Attendance</a>
        </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ruler-vertical"></i>
            <span>Outlet</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{route('outletInfo')}}">My Outlet</a>
            <a class="dropdown-item" href="{{route('designOutlet')}}">Design Outlet</a>
            <a class="dropdown-item" href="{{route('editOutlet')}}">Edit Outlet</a>
          </div>
        </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-tasks"></i>
            <span>Manage Employee</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{route('addEmployeePage')}}">Add Employee</a>
            <a class="dropdown-item" href="{{route('employeeList')}}">Employee List</a>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-boxes"></i>
              <span>Products</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="{{route('ProductTypePage')}}">Add Catagory</a>
              <a class="dropdown-item" href="{{route('addProductPage')}}">Add Product</a>
              <a class="dropdown-item" href="{{route('productList')}}">Product List</a>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-table"></i>
              <span>Seat Reservation</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="{{route('booking')}}">Seat Booking</a>
              <a class="dropdown-item" href="{{route('bookedSeats')}}">Reserved Seats</a>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-sort-alpha-up"></i>
              <span>Orders</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="{{route('pendingOrders')}}">Pending Orders</a>
              <a class="dropdown-item" href="{{route('completedOrders')}}">Completed Orders</a>
          </div>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('manager.profile')}}">
              <i class="fas fa-user-circle"></i>
              <span>User Profile</span>
            </a>
        </li>
    </ul>

    <div id="content-wrapper" style="" class="bg-primary">
      <div class="container-fluid col-sm-10 offset-sm-1">
          @yield('content')
      </div>
      <div class="container-fluid col-sm-10 offset-sm-1">
          @yield('booking')
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer" style="">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Multi Outlet Management System 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

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
          <a class="btn btn-primary" href="/manager/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/custom/vendor/jquery/jquery.min.js"></script>
  <script src="/custom/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/custom/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="/custom/vendor/chart.js/Chart.min.js"></script>
  <script src="/custom/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/custom/vendor/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/custom/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/custom/js/demo/datatables-demo.js"></script>
  <script src="/custom/js/demo/chart-area-demo.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/custom/js/demo/chart-area-demo.js"></script>
  <script src="/custom/js/demo/chart-bar-demo.js"></script>
  <script src="/custom/js/demo/chart-pie-demo.js"></script>

  @yield('script')

</body>

</html>
