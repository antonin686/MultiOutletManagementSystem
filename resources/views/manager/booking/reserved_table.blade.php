@extends('manager.base')
@section('content')
<div class="card">
<div class="card-header alert alert-info" style="text-align:center"><strong>Reserved Seats</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
                <thead class="thead-dark" align="center">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">CUSTOMER NAME</th>
                    <th scope="col">CONTACT</th>
                    <th scope="col">TOTAL CUSTOMERS</th>
                    <th scope="col">DATE & TIME</th>
                    <th scope="col">TABLE NO.</th>
                    <th scope="col">OPERATIONS</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach($booking as $book)
                    <tr class="bg-light" id="{{$book->id}}">
                        <th scope="row"> {{$book->id}} </th>
                        <td>{{$book->booked_for}}</td>
                        <td>{{$book->contact}}</td>
                        <td>{{$book->cus_amount}}</td>
                        <td>{{$book->time}}</td>
                        <td>Table - {{$book->table_id}}</td>
                        <td>
                            <input type="button" name="delete" value="Cancel" id="{{$book->id}}" class="btn btn-danger delete_data"></input>
                        </td>
                    </tr>
                    @endforeach
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
                <h5 align="center" style="margin:0;">Are you sure you want to cancel this reservation?</h6>
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
});

var seat_id;

$(document).on('click', '.delete_data', function(){
seat_id = $(this).attr('id');
$('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
$.ajax({
url:"/manager/bookedSeats/delete/"+seat_id,
beforeSend:function(){
$('#ok_button').text('Cancelling...');
},
success:function(data)
{
setTimeout(function(){
    $('#confirmModal').modal('hide');
    location.reload();
    alert('Seat Reservation Cancelled!!');
}, 2000);
}
})
});
</script>
@endsection