<!DOCTYPE html>
<html>
 <head>
  <title>Order Status</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>

 <div style="background: #800080;" >
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/seller/home">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/seller/food-items">Item List</a></li>
                <li class="breadcrumb-item"><a href="/seller/order-status">Order Status</a></li>
                <li class="breadcrumb-item"><a  active" href="#"">
                   User: {{Auth::user()->username}}
                </a></li>
                
        </ol>  
    </div>
</section>
</div>
  <br />
  <div class="container box">
   <h3 align="center">Order Status</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">Orders</div>
    <div class="panel-body">
     <div id="message"></div>
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Token Number</th>
         <th>Order</th>
         <th>Served</th>
        </tr>
       </thead>
       <tbody>
        <tr>
            <td contenteditable id="TokenNo">29</td>
            <td contenteditable id="Order">Burger</td>
            <td><button type="button" class="btn btn-success btn-xs" id="add">Done</button></td>
        </tr>
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>
 </body>
</html>

