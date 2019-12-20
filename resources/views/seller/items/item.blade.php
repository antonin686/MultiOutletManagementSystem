<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Items</title>

    <link rel="stylesheet" href="/custom/jQuery/dataTable.min.css">
   
     <!-- Custom fonts for this template-->
    <link href="/custom/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/custom/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/custom/css/sb-admin.css" rel="stylesheet">
    <!-- Custom added jQuery library for this template-->
    <script src="/seller/jQuery/jquery-3.4.1.min.js"></script>
    <script src="/seller/jQuery/dataTable.min.js"></script>

    <style>
    body{
    background-image: url("/seller/img/itemListBodyBG.jpg") !important;
    background-repeat: repeat;
    background-size: contain;
    }
    .cont{
    background: url("/seller/img/itemListBG.jpg");
    background-repeat: repeat;
    background-size: contain;
    text-align: center;
    
    height: 300px;
    width: 300px;
    }
    #menu{
    background-color: black; 
    text-align: center;
    margin-top: 100px;
    }
    </style>

</head>
<body>

<nav class="navbar py-0 navbar-expand-sm navbar-dark" style="background-color: black;" >
    <!-- Brand Logo -->
    <a class="navbar-brand" href="#"> Welcome {{Auth::user()->username}} | </a>
    <!-- Nav Bar -->
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/seller/home">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/seller/order-status">Order Status</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/seller/inventory">Inventory</a>
      </li>
    </ul>
  
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="/seller/notification"><i class="fas fa-bell"></i></a>
          </li>
    </ul>
  </nav>

  <div id="header" style="background: #333333;color: white;padding: 10px;margin-bottom: 15px;" >
    <div class="container">
      <div class="row">
        <div class="col-md-10">
  
          <div id="dashboard-text">
              <h1> <span><i class="fas fa-list-alt"></i></span> Item List <small class="text-secondary"> of foods ! </small></h1>
          </div>       
        </div>
      </div>
    </div>
  </div>

  <div id="stickyNoteSpace"> HI </div>

  <!-- Body -->

  <div class="body">
        <div class="row justify-content-md-center" >

                <div class="col-md-3 cont" id="firstDiv" >
                  <table id="menu" align="center">
                    <tr>
                      <td>
                       <a href="#">Add New Item</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#">Remove an Item</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#">Update Item Info</a>
                      </td>
                    </tr>
                  </table> 
                </div>
            
                <div class="col-md-8" style="background:#ADA6AC;" >
                    <table border="1" id="dataTable" style="padding: 5px;">
                      <thead>
                        <tr>
                          
                          <th>Item Code</th>
                          <th>Item Type</th>
                          <th>Item Name</th>
                          <th>Ingredient</th>
                          <th>Item Price</th>
                        </tr>
                      </thead>

                      <tbody>
                       
                        @foreach($info as $s)
                            <tr>
                                
                                <td>{{$s->item_code}}</td>
                                <td>{{$s->item_type}}</td>
                                <td>{{$s->item_name}}</td>
                                <td>{{$s->ingredient}}</td>
                                <td>{{$s->item_cost}}</td>            
                            </tr>
                        @endforeach
                     
                      </tbody>
                        
                        
                                                
                    </table>
                </div>
            
              </div>
  </div>
<script>
$(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
</body>
</html>