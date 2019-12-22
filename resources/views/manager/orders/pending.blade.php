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
        <h6 class="m-0 font-weight-bold text-primary">Pending Orders</h6>
    </div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="myTable">
        <thead class="thead-dark" align="center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Food Name</th>
            <th scope="col">Food Cost</th>
            <th scope="col">OPERATIONS</th>
          </tr>
        </thead>
        <tbody align="center">
            @if ($data != null)
                @foreach($data as $dt)
                <tr class="bg-light" id="{{$dt->id}}">
                    <th scope="row"> {{$dt->id}} </th>
                    <td>{{$dt->cus_name}}</td>
                    <td>{{$dt->cus_contact}}</td>
                    <td>{{$dt->food_name}}</td>
                    <td>{{$dt->food_cost}}</td>
                    <td>
                        <input type="button" name="delete" value="Cancel" id="{{$dt->id}}" class="btn btn-danger delete_data"></input>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
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

    var user_id;

    $(document).on('click', '.delete_data', function(){
    order_id = $(this).attr('id');
    $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
    $.ajax({
    url:"/manager/orders/pending/delete/"+order_id,
    beforeSend:function(){
    $('#ok_button').text('Cancelling...');
    },
    success:function(data)
    {
    setTimeout(function(){
        $('#confirmModal').modal('hide');
        location.reload();
        alert('Order Deleted');
    }, 2000);
    }
    })
});

});
</script>
@endsection

