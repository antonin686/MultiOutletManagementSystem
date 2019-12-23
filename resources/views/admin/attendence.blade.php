@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Attendence</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Employee Attendence</h4>
                <p class="category">Today</p>
            </div>
            <div class="card-body">
                <div class="col-md-4 ml-auto">
                <div class="form-group">
                    <select class="custom-select" id="select_outlet">
                        @foreach($tables->outlets as $outlet)
                        <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <table id="table-attendence" class="table table-hover">
                    <thead class="text-warning">
                        <th>Employee Name</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach($tables->attends as $attend)
                        <tr id="{{$attend->out_id}}">
                            <td>{{$attend->emp_name}}</td>
                            <td>{{$attend->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
    
    $('#table-attendence').DataTable();

    attendSelectOutlet();

    $('#select_outlet').on('change', (event) => {
        attendSelectOutlet();
    });

    function attendSelectOutlet() {
        out_id = $('#select_outlet').val();
        //table = $('#table-order');
        //console.log(out_id);

        $('#table-attendence > tbody tr').each(function() {
            var rowID = $(this).attr('id');

            if (rowID == out_id) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

});
</script>
@endsection


