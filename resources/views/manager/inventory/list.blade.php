@extends('manager.base')

@section('content')

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach
@endif

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif
<div class=" shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
    </div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="myTable">
        <thead class="thead-dark" align="center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">TYPE</th>
            <th scope="col">PRODUCT CODE</th>
            <th scope="col">PRICE</th>
            <th scope="col">OPERATIONS</th>
          </tr>
        </thead>
        <tbody align="center">
            @if ($inventory != null)
                @foreach($inventory as $dt)
                <tr class="bg-light" id="{{$dt->id}}">
                    <th scope="row"> {{$dt->id}} </th>
                    <td>{{$dt->name}}</td>
                    <td>{{$dt->type}}</td>
                    <td>{{$dt->code}}</td>
                    <td>{{$dt->cost}} Tk.</td>
                    <td>
                        <input type="button" name="edit" value="Edit" id="{{$dt->id}}" class="btn btn-primary edit_data"></input>
                        <input type="button" name="delete" value="Delete" id="{{$dt->id}}" class="btn btn-danger delete_data"></input>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </div>
</div>
</div>  

{{-- edit modal --}}
<div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">  
             <div class="modal-content">  
                  <div class="modal-header">  
                      <h4 class="modal-title">Edit</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>    
                  </div>  
                  <div class="modal-body">
                        <form method="post" id="insert_form" action="{{route('updateProduct')}}">
                            @csrf
                            <label>Name</label>  
                            <input type="text" name="name" id="name" class="form-control" />  
                            <br />  
                            <label>Price</label>  
                            <input type="text" name="price" id="price" class="form-control"></input>  
                            <br />  
                            <input type="hidden" name="product_id" id="product_id" />  
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                        </form>  
                    </div>
                  <div class="modal-footer">  
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                  </div>  
             </div>  
        </div>  
   </div>

{{-- delete modal --}}
<div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5 align="center" style="margin:0;">Are you sure you want to remove this data?</h6>
                </div>
                <div class="modal-footer">
                 <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script >
        $(document).ready( function () {
        $('#myTable').DataTable();
    
    
    $(document).on('click', '.edit_data', function(){
               var product_id = $(this).attr("id");
               //alert(product_id);  
               $.ajax({  
                    url:"/manager/productlist/edit", 
                    method:"GET",  
                    data:{product_id:product_id}, 
                    dataType:"json",  
                    success:function(data){ 
                        //$leads = json_decode($leads, true);
                        //dd($leads);
                         console.log(data);
                         $('#name').val(data['name']);  
                         $('#price').val(data['cost']);  
                         $('#product_id').val(data['id']);
                         $('#insert').val("Update");  
                         $('#add_data_Modal').modal('show');  
                    }  
               });  
          });  
         
        var product_id;
    
        $(document).on('click', '.delete_data', function(){
        product_id = $(this).attr('id');
        $('#confirmModal').modal('show');
        });
    
        $('#ok_button').click(function(){
        $.ajax({
        url:"/manager/productlist/delete/"+product_id,
        beforeSend:function(){
        $('#ok_button').text('Deleting...');
        },
        success:function(data)
        {
        setTimeout(function(){
            $('#confirmModal').modal('hide');
            location.reload();
            alert('Data Deleted');
        }, 2000);
        }
        })
    });
    
    });
    </script>
@endsection