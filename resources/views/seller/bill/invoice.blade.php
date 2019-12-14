<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Laravel Ajax needs !-->
    <title>Invoice</title>

 <!-- Custom fonts for this template-->
 <link href="/custom/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="/custom/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="/custom/css/sb-admin.css" rel="stylesheet">

<!-- Custom added Jquery for this template-->
<script src="/custom/jQuery/jquery-3.4.1.min.js"></script>

</head>
<body>
    <!--Body section-->
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

<div id="header" style="background: #333333;color: white;padding: 10px;margin-bottom: 15px;" >
    <div class="container">
      <div class="row">
        <div class="col-md-10">
  
          <div id="dashboard-text">
              <h1> <span><i class="fas fa-list-alt"></i></span> Invoice <small class="text-secondary">BIN: 007286837 </small></h1>
          </div>       
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="card-body">
        <div class="col-md-8 mx-auto">

            <form class="card-body" method="POST">
                {{csrf_field()}}
                    <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" name="username">
                        </div>  
                        <div class="form-group">
                            <label for="name">Contact</label>
                            <input type="number" class="form-control" name="contact" >
                        </div>              
                        <div class="form-group">
                            <label for="customerToken">Token Number</label>
                            <input type="text" value="{{$newToken}}" class="form-control" name="token">
                        </div>
                        <div class="form-group">
                            <label  for="outlet">Ticket Number</label>
                            <input type="text" class="form-control" name="ticket" id="ticket"  readonly>    
                        </div>

                        <div class="form-group">
                            <table border="1px" align="center">
                                <thead>
                                    <tr>
                                        <th>Food Code</th>
                                        <th>Food Name</th>
                                        <th>Price</th>
                                        <th><button type="button" name="addMore" id="addMore" class="btn btn-success btn_add"><b>ADD Items</b></button></th>
                                    </tr>
                                </thead>
                                <tbody  id="orders">
                                    <tr></tr>
                                </tbody>
                            </table>

                            <div class="form-group" style="background: cadetblue;font-family:Arial;font-size: 150%;font-weight: bold; margin-top: 5px;" >
                                <label>Total : </label>
                                <label name="sum" id="result" for="sum">0000</label>
                                <input type="button" value="View Total" class="btn btn-info btn-lg"  id="total">   
                            </div>

                        </div>

                        
                
                <button type="submit" class="btn btn-success">Confirm Order</button>

            </form>
        </div>  
    </div>
</div>
           
<!--Body Section End-->
<script>
$(document).ready(function(){

    var i = 1 ;
    var sum= 0 ;
    var d = new Date();
    var e = Math.random();
    var f = 0 ;
    var g = 0;
    var h = 0;
    var m = 0;
    $('#ticket').val(d + e);
    $('#addMore').on('click',function(){
        i++;
        $('#orders').append('<tr id="orderedItems'+i+'" ><td class="f_code"><input type="text" id="food_code" class="'+i+'" name="code[]"></td><td class="f_name">Burger</td><td> <input type="text" class="cost" id="cost'+i+'" name="cost[]"> </td><td><button type="button" id="'+i+'" class="btn btn-danger btn_remove"><b>Remove</b></button></td></tr>');
        //sum.val(0) ;
    });
    $('#total').on('click',function(){
        
        $('.cost').each(function(){
            sum += Number($(this).val());
        });
        $("#result").css("background-color", "yellow");
        $('#result').text(sum);
    });
    $(document).on('click','.btn_remove',function(){
    var btn_rmv=$(this).attr("id");
    var h = $('#cost'+btn_rmv+'').val();
    
    //alert(w);
    $('#orderedItems'+btn_rmv+'').remove();
    
    var m = parseFloat(sum)-parseFloat(h);
    
    $('#result').text(m);
    });

    
   
    $(document).on('keyup','#food_code',function(e){
        var f =$(this).val();
        var w =$(this).attr("class");
        //alert(w);
        //var f = $('#food_code').val();
        //var j= $(e.currentTarget).text();
        console.log(f);
                     $.ajax({
                    url: `/seller/invoice/searchAjax`, 
                    type:'GET',
                    
                    dataType:"json",
                    data:{query:f},
                    success: (f_cost) => {
                        console.log(f_cost);
                        var html = '';
                        
                        if(f_cost != null)
                        {
                            var g = f_cost.item_cost;
                            $('#cost'+w+'').val(g)
                        
                        }
                    }
                    });
    });
   
    

    
});
</script>
</body>
</html>