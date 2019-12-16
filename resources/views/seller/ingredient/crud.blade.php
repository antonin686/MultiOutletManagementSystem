<!DOCTYPE html>
<html>
 <head>
  <title>Order Status</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom added Jquery for this template-->
    <script src="/seller/jQuery/jquery-3.4.1.min.js"></script>
    <script src="/seller/jQuery/timer/jquery.simple.timer.js"></script>
    
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
        <form method='POST'>
        {{ csrf_field() }}
            <table class="table table-striped table-bordered">
            <thead>
            <tr>
            <th>ID</th>
            <th>Token Number</th>
            <th>Time</th>
            <th>Served</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @foreach($info as $s)
                    <tr>
                        <td>{{$s->id}}</td>                  
                        <td>{{$s->token}}</td>
                        <td> <p class='timer' data-minutes-left=10></p></td>
                        <td>
                        <a href="{{route('served', $s->id)}}" class="btn btn-success btn-xs" >Done</a></td>
            @endforeach
                
                
            </tr>
        </tbody>
        </table>
        </form>
      
     </div>
    </div>
   </div>
  </div>

  <script>
$(document).ready(function(){
    $('.timer').startTimer();


});
</script>

 </body>
</html>

