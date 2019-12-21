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
<div class="card">
<div class="card-header alert alert-info" style="text-align:center"><strong>Edit Outlet</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
                <thead class="thead-dark" align="center">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">TABLE NAME</th>
                    <th scope="col">SEATS</th>
                    <th scope="col">OPERATIONS</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach($design as $d)
                    <tr class="bg-light" id="{{$d->id}}">
                        <th scope="row"> {{$d->id}} </th>
                        <td>Table - {{$d->table_id}}</td>
                        <td>{{$d->seats}}</td>
                        <td>
                            <input type="button" name="edit" value="Edit" id="{{$d->id}}" class="btn btn-primary edit_data"></input>
                            <input type="button" name="delete" value="Delete" id="{{$d->id}}" class="btn btn-danger delete_data"></input>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- edit modal --}}
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog modal-lg">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>    
                </div>  
                <div class="modal-body">
                    <form method="post" id="insert_form" action="{{route('updateOutlet')}}">
                        @csrf
                        <label>Seats</label>  
                        <input type="text" name="seats" id="seats" class="form-control" />  
                        <input type="hidden" name="seat_id" id="seat_id" />  
                        <br />  
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
           var seat_id = $(this).attr("id");
          // alert(seat_id);  
           $.ajax({  
                url:"/manager/outlet/edit", 
                method:"GET",  
                data:{seat_id:seat_id}, 
                dataType:"json",  
                success:function(data){ 
                    //$leads = json_decode($leads, true);
                    //dd($leads);
                     console.log(data);
                     $('#seats').val(data['seats']); 
                     $('#seat_id').val(data['id']);
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  

    var seat_id;

    $(document).on('click', '.delete_data', function(){
    seat_id = $(this).attr('id');
    $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
    $.ajax({
    url:"/manager/outlet/table/delete/"+seat_id,
    beforeSend:function(){
    $('#ok_button').text('Deleting...');
    },
    success:function(data)
    {
    setTimeout(function(){
        $('#confirmModal').modal('hide');
        location.reload();
        alert('Table Deleted');
    }, 2000);
    }
    })
});

});
</script>
@endsection
