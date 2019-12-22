@extends('admin.layout')

@section('breadcrumb')

<li class="breadcrumb-item active" aria-current="page">Seat Booking</li>

@endsection

@section('content')
<form method="POST">
    @csrf
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Booking</h4>
                    <p class="category">Create Booking</p>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                    <p class="alert alert-danger mb-3">
                        @foreach ($errors->all() as $error)
                        {{$error}} <br>
                        @endforeach
                    </p>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="col">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Contact</label>
                                <input type="text" name="contact" value="{{old('contact')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="">Time</label>
                                <input type="date" name="time" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="out_id">Outlet</label>
                                <select class="custom-select" id="select_outlet" name="out_id">
                                    @foreach($outlets as $outlet)
                                    <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label>Table</label> <br>
                            <button type="button" class="btn btn-dark btn-round" data-toggle="modal"
                                data-target="#exampleModal">
                                Select Table
                            </button>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-round pull-right">Book Table</button>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table-booking" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Seats</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                            <tr id="{{$table->out_id}}">
                                <td>{{$table->table_name}}</td>
                                <td>{{$table->seats}}</td>
                                <td>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="table"
                                                id="{{$table->id}}" value="{{$table->id}}">
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</form>
<script>
$(document).ready(function() {

    getTables();

    $('#select_outlet').on('change', (event) => {
        getTables();
    });

    function getTables() {
        var out_id = $('#select_outlet').val();

        $('#table-booking > tbody tr').each(function() {
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