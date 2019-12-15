<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Laravel Ajax needs !-->
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
    <form method="POST">

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
                    <select class="custom-select" id="prod_name1" name="prod_name[]" required>
                    
                            <option value="Chicken"> Chicken</option>
                            <option value="beef">Beef</option>
                            <option value="potato">Potato</option>
                            <option value="mutton">Mutton</option>   
                    </select>
                </td>
                <td>
                    <select class="custom-select" id="prod_type1" name="prod_type[]" required>
                            
                            <option id='chicken' value="chicken Brest"> Chicken Brest </option>
                            <option id='chicken' value="chicken legs"> Chicken Legs </option>
                            <option id='chicken' value="Chicken Wings"> Chicken Wings </option>
                            <option id='chicken' value="chicken bacon"> Chicken Bacon </option>
                            <option id='beef' value="beef steak"> Beef Steak </option>
                            <option id='beef' value="beef bacon"> Beef Bacon </option>
                            <option id='potato' value="potato slice"> Potato Slice </option>
                            
                    </select>
                </td>
                <td><input type="text" name=date[] id="datepicker" placeholder="Pick a date(dd/mm/yy)"></td>
                <td><input type="text" id="opening1" name="opening[]" ></td>
                <td><input type="text" id="rec1"name="rec[]" ></td>
                <td><input type="text" id="total1" name="total[]" ></td>
                <td><input type="text" id="exp1" name="exp[]"></td>
                <td><input type="text" id="bal1" name="bal[]" ></td>
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
  var f = 0;
  
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
    var ref=0;
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
    $('#tab-body').append('<tr id="insertInventory'+i+'"> <td class="ser" id="getSerial" >'+i+'</td> <td><select class="prod_name'+i+'" id="prod_name" name="prod_name[]" required><option value="Chicken"> Chicken</option><option value="beef">Beef</option><option value="potato">Potato</option><option value="mutton">Mutton</option></select></td><td><select class="'+i+'" id="prod_type" name="prod_type[]" required><option id="chicken" value="chicken Brest"> Chicken Brest </option><option id="chicken" value="chicken legs"> Chicken Legs </option><option id="chicken" value="Chicken Wings"> Chicken Wings </option><option id="chicken" value="chicken bacon"> Chicken Bacon </option><option id="beef" value="beef steak"> Beef Steak </option><option id="beef" value="beef bacon"> Beef Bacon </option><option id="potato" value="potato slice"> Potato Slice </option></select></td><td><input type="text" name="date[]" id="datepickerClone" placeholder="Pick a date" value="'+D+'" ></td><td><input type="text" id="opening'+i+'" name="opening[]" ></td><td><input type="text" id="rec'+i+'" name="rec[]" ></td><td><input type="text" id="total'+i+'" name="total[]" ></td><td><input type="text" id="exp'+i+'" name="exp[]" ></td><td><input type="text" id="bal'+i+'" name="bal[]" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><b>-</b></button></td></tr>');
    $( "#datepicker" ).datepicker(); 
   
  });
  
  $(document).on('click','.btn_remove',function(){
    var btn_rmv=$(this).attr("id");
    $('#insertInventory'+btn_rmv+'').remove();
  });

  $(document).on('change','#prod_type',function(e){
    ref =$(this).attr("class");
    console.log(ref);
  });

  $(document).on('change','#prod_name' | '#prod_type',function(e){
    //ver u = 
    var f =$('#prod_name1').val();
    var ft =$('#prod_type1').val();
    //console.log(ft);
    console.log(ref);
    $.ajax({
                    url: `/seller/insert-raw-goods/searchAjax`, 
                    type:'GET',
                    dataType:"json",
                    data:{p_name:f , p_type:ft},
                    success: (f_cost) => {
                        //console.log(f_cost);
                        var html = '';
                        
                        if(f_cost != null)
                        {
                            var g = f_cost;
                          
                            $('#opening1').val(g)
                            //console.log(gb);
                            //console.log(g);
                        
                        }
                        else{
                          $('#opening1').val(0)
                        }
                    }
                    });
  });
  
  
});
</script>
</body>
</html>