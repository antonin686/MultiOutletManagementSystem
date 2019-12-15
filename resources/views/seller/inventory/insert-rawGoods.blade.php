<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Raw Goods</title>

<!-- Custom fonts for this template-->
<link href="/custom/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="/custom/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="/custom/css/sb-admin.css" rel="stylesheet">

<link rel="stylesheet" href="/seller/jQuery/ui/jquery-ui.css">
<!-- Custom added Jquery for this template-->
<script src="/custom/jQuery/jquery-3.4.1.min.js"></script>
<script src="/seller/jQuery/ui/jquery-ui.js"></script>
    <style>
    .table {
    border-radius: 5px;
    width: 50%;
    margin: 0px auto;
    float: none;
    }   


    body{
    background-image: url("/seller/img/itemListBodyBG.jpg") !important;
    background-repeat: repeat;
    background-size: contain;
    }
    </style>
</head>
<body>
<nav class="navbar py-0 navbar-expand-sm navbar-dark" style="background-color: black;" >
    <!-- Brand Logo -->
    <a class="navbar-brand" href="#"> Logo </a>
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
      <!-- Dropdown -->
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbardrop" data-toggle="dropdown">
              Welcome, {{Auth::user()->username}}
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Logout</a>
          </div>
        </li>
    </ul>
  </nav>

  <div id="header" style="background: #333333;color: white;padding: 10px;margin-bottom: 15px;" >
    <div class="container">
      <div class="row">
        <div class="col-md-10">
  
          <div id="dashboard-text">
              <h1> <span><i class="fas fa-list-alt"></i></span> Raw Goods Inventory <small class="text-secondary"> Data Entry </small></h1>
          </div>       
        </div>
      </div>
    </div>
  </div>

  
<!--Body-->
  <div style="background: rgb(254, 201, 154, .8) ;">
    <form action="">

    {{csrf_field()}}
        <table id="rawGoodsInsert" border="1px" align="center" >
 
            <thead>
              <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Date</th>
                <th>Opening(kg)</th>            
                <th>Receive(kg)</th>
                <th>Total(kg)</th>
                <th>Exp(kg)</th>
                <th>Balance(kg)</th>
                <th>Add</th>
              </tr>
            </thead>
            <tbody id="tab-body" >
              <tr id="insertInventory1" >
                  <td class="ser" >1</td>
                <td>
                    <select class="custom-select" name="name" required>
                        
                            <option value="chicken wings"> Chicken Wings </option>
                       
                      </select>
                </td>
                <td>
                    <select class="custom-select" name="type" required>
                     <option value="chicken">Chicken</option>  
                    </select>
                </td>
                <td><input type="text" id="datepicker" placeholder="Pick a date(dd/mm/yy)"></td>
                <td><input type="text" id="opening1" value="{{$lastBal}}" ></td>
                <td><input type="text" id="rec1" ></td>
                <td><input type="text" id="total1" ></td>
                <td><input type="text" id="exp1" ></td>
                <td><input type="text" id="bal1" ></td>
                <td><button type="button" name="addMore" id="addMore" class="btn btn-success btn_add"><b>+</b></button></td>
              </tr>
            </tbody>
            <tr>
                <td colspan="9" >
                 <div class="warp" style="text-align: center;" >
                  <button type="submit" class="btn btn-success" style="margin-top: 2ex; margin-bottom: 2ex;" >Save</button>
                </div> 
                </td>
              </tr>
        </table>
    </form>
  </div>
<!--Body-->

<!--script-->
<script>
$(document).ready(function(){
  var i = 1 ;
  var D= "dd/mm/yy";
  var j = 1;
  
  //var picker = "a";
/*
  $(document).on('click','input',function() {
    var j = $(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".ser").text();         // Gets a descendent with class="nr" & Retrieves the text within <td>;
                       console.log(j);
    });
 */               
 
  $(document).on('keyup','input',function cal(){
    //var j = 1 ;
    var j = $(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".ser").text();         // Gets a descendent with class=".ser" & Retrieves the text within <td>;
                       console.log(j);
    //var k=$('td').attr("id");
    
    var a=$('#opening'+j).val();
    var b=$('#rec'+j).val();
    var c=$('#exp'+j).val();
    var total = parseFloat(a) + parseFloat(b);
    var bal = parseFloat(total) - parseFloat(c);
    $('#total'+j).val(total);
    $('#bal'+j).val(bal);
  });
  $( function() {
    $( "#datepicker" ).datepicker({
      showAnim:'fold',
      dateFormat:'dd/mm/yy',
      minDate:'0',
      maxDate:'+1D',
      setDate:'1D',
    });
    $('#datepicker').datepicker('setDate', 'today');
  } );
  $('body').on('click','#addMore',function(){
    
    //var picker = $("<input/>", {type: 'text',id:'lol',}).datepicker();
    
    var D = $('#datepicker').val(); //clone Date
    i++
    $('#tab-body').append('<tr id="insertInventory'+i+'"> <td class="ser" >'+i+'</td> <td><select class="custom-select" name="name" required><% for(var i=0; i < itemList.length; i++) {%><option value="<%= itemList[i].item_type %>"> <%= itemList[i].product_name %> </option><% } %></select></td><td><select class="custom-select" name="type" required><% for(var i=0; i < itemList.length; i++) {%><option value="<%= itemList[i].item_type %>"> <%= itemList[i].product_type %> </option><% } %></select></td><td><input type="text" id="datepickerClone" placeholder="Pick a date" value="'+D+'" ></td><td><input type="text" id="opening'+i+'" ></td><td><input type="text" id="rec'+i+'" ></td><td><input type="text" id="total'+i+'" ></td><td><input type="text" id="exp'+i+'" ></td><td><input type="text" id="bal'+i+'"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><b>-</b></button></td></tr>');
    $( "#datepicker" ).datepicker(); 
   
  });
  
  $(document).on('click','.btn_remove',function(){
    var btn_rmv=$(this).attr("id");
    $('#insertInventory'+btn_rmv+'').remove();
  });
  
});
</script>
</body>
</html>