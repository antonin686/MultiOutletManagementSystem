<!DOCTYPE html>
<html>
 <head>
  <title>Order Status</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom added Jquery for this template-->
    <script src="/seller/jQuery/jquery-3.4.1.min.js"></script>

    
    <script src="/seller/jQuery/dataTable.min.js"></script>
 
    
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
   <h3 align="center">View Inventory</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">
    <select class="btn btn-primary dropdown-toggle form-control" name="inventory_type" id="inventory_type">
        <option value="null"> Select Type</option>
        <option value="raw"> Raw Goods </option>
        <option value="pac"> Packed Materials </option>
    </select>
    </div>
    <div class="panel-body">
     <div id="message"></div>
     <div class="table-responsive">

        {{ csrf_field() }}
        <div class="pac" >
        <table id="dataTable" class="table table-striped table-bordered">
                
        
            <thead>
                <tr>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Cost</th>           
                <th>Expire Date</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach($info as $s)
                    <tr>             
                            <td>{{$s->prod_name}}</td>
                            <td>{{$s->prod_type}}</td>
                            <td>{{$s->cost}}</td>
                            <td>{{$s->exp_date}}</td>
                    </tr>        
                    @endforeach  
            
            </tbody>
       

        </table>  
    </div>    
</div>
</div>

<div class="msg" > <h1 style="text-align:center;" > Please, Select a Type to View the Inventory Records </h1> </div>
    
<div class="raw">


        <div class="panel-body">
        <div id="message"></div>
        <div class="table-responsiveh">
        <table id="dataTableRaw" class="table table-striped table-bordered" >
 
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Date</th>
                <th>Opening(kg)</th>            
                <th>Receive(kg)</th>
                <th>Total(kg)</th>
                <th>Exp(kg)</th>
                <th>Balance(kg)</th>
              </tr>
            </thead>
            <tbody id="tab-body" >
            @foreach($data as $h)
              <tr>
                <td>{{$h->product_name}}</td>
                <td>{{$h->product_type}}</td>
                <td>{{$h->date}}</td>
                <td>{{$h->opening}}</td>
                <td>{{$h->receive}}</td>
                <td>{{$h->total}}</td>
                <td>{{$h->exp}}</td>
                <td>{{$h->balance}}</td>
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
    $('#dataTableRaw').DataTable();
    $('.pac').hide();
    $('.raw').hide();
    $('.msg').hide();

    $(document).on('change','#inventory_type',function(){
       var f = $(this).val();
       //console.log(f);
       if(f=="raw"){
        $('.raw').show();
        $('.pac').hide();
        $('.msg').hide();
       }
       else if(f=="pac"){
        $('.pac').show();
        $('.raw').hide();
        $('.msg').hide();
       }
       else if(f=="null"){
        //console.log(f);
        $('.msg').show();
        $('.pac').hide();
        $('.raw').hide();
       }
       else{
        $('.pac').hide();
        $('.raw').hide();
       } 
    });

} );

</script>

 </body>
</html>

