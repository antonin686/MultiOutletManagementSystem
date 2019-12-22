@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Tables</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 col-md-12 mx-auto">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tables:</span>

                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#employee" data-toggle="tab">
                                    <i class="material-icons">people</i> Employee
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#outlet" data-toggle="tab">
                                    <i class="material-icons">store</i> Outlet
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#booking" data-toggle="tab">
                                    <i class="material-icons">check_box</i> Booking
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#order" data-toggle="tab">
                                    <i class="material-icons">fastfood</i> Order
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#inventory" data-toggle="tab">
                                    <i class="material-icons">home_work</i> Inventory
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="employee">
                        <a class="btn btn-info btn-round mb-2" href="{{ route('employee.create') }}">
                            Add Employee
                        </a>
                        <div class="">
                            <div class="card-body table-responsive">
                                <table id="table-employee" class="table table-hover">
                                    <thead class="text-warning">
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Salary</th>
                                        <th>Role</th>
                                    </thead>
                                    <tbody>
                                        @foreach($tables->emps as $emp)
                                        <tr id="{{$emp->id}}">
                                            <td>{{$emp->id}}</td>
                                            <td>{{$emp->username}}</td>
                                            <td>{{$emp->salary}}</td>
                                            <td>{{$emp->role_name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="outlet">
                        <a class="btn btn-info btn-round mb-2" href="{{ route('outlet.create') }}">
                            Add Outlet
                        </a>
                        <div class="card-body table-responsive">
                            <table id="table-outlet" class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Salary</th>
                                    <th>Role</th>
                                </thead>
                                <tbody>
                                    @foreach($tables->outlets as $outlet)
                                    <tr id="{{$outlet->id}}">
                                        <td>{{$outlet->id}}</td>
                                        <td>{{$outlet->out_name}}</td>
                                        <td>{{$outlet->location}}</td>
                                        <td>{{$outlet->city}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="booking">
                        <a class="btn btn-info btn-round mb-2" href="{{ route('booking.create') }}">
                            Add Booking
                        </a>
                        <div class="col-md-4 pull-right">
                            <div class="form-group">
                                <select class="custom-select" id="select_booking_outlet">
                                    @foreach($tables->outlets as $outlet)
                                    <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table id="table-booking" class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Booked For</th>
                                    <th>Contact</th>
                                    <th>Time</th>
                                    <th>Table Name</th>
                                </thead>
                                <tbody>
                                    @foreach($tables->bookings as $booking)
                                    <tr id="{{$booking->out_id}}">
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->booked_for}}</td>
                                        <td>{{$booking->contact}}</td>
                                        <td>{{$booking->time}}</td>
                                        <td>{{$booking->table_name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="order">
                        <div class="col-md-4 pull-right">
                            <div class="form-group">
                                <select class="custom-select" id="select_outlet">
                                    @foreach($tables->outlets as $outlet)
                                    <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table id="table-order" class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </thead>
                                <tbody>
                                    @foreach($tables->orders as $order)
                                    <tr id="{{$order->out_id}}">
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->item_name}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->total_price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="inventory">

                        <div class="col">
                            <div class="col-md-4 ml-auto">
                                <div class="form-group">
                                <label for="">Outlet Name</label>
                                    <select class="custom-select" id="select_inv_outlet">
                                        @foreach($tables->outlets as $outlet)
                                        <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 ml-auto">
                                <div class="form-group">
                                <label for="">Inventory Type</label>
                                    <select class="custom-select" id="select_inv_type">
                                        @foreach($tables->inv_types as $type)
                                        <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>

                        </div>

                        <div class="card-body table-responsive">
                            <table id="table-inventory" class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Total Cost</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    @foreach($tables->invs as $inv)
                                    <tr id="{{$inv->inv_type}}^{{$inv->out_id}}">
                                        <td>{{$inv->id}}</td>
                                        <td>{{$inv->inv_name}}</td>
                                        <td>{{$inv->quantity}}</td>
                                        <td>{{$inv->cost}}</td>
                                        <td>{{$inv->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(() => {

    orderSelectOutlet();
    inventorySelectType();
    bookingSelectOutlet();

    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };

    activaTab('{{$tables->tab}}');

    $('#table-employee').DataTable();
    $('#table-outlet').DataTable();
    $('#table-order').DataTable();
    $('#table-inventory').DataTable();
    $('#table-booking').DataTable();

    $('#table-employee').on('click', 'tr', (event) => {

        var id = $(event.currentTarget).attr("id");

        if (id != null) {
            window.location.href = `/admin/employee/show/${id}`;
        }
    });

    $('#table-outlet').on('click', 'tr', (event) => {

        var id = $(event.currentTarget).attr("id");

        if (id != null) {
            window.location.href = `/admin/outlet/show/${id}`;
        }
    });

    $('#select_outlet').on('change', (event) => {
        orderSelectOutlet();
    });

    $('#select_booking_outlet').on('change', (event) => {
        bookingSelectOutlet();
    });

    $('#select_inv_type').on('change', (event) => {
        inventorySelectType();
    });

    $('#select_inv_outlet').on('change', (event) => {
        inventorySelectType();
    });

    function orderSelectOutlet() {
        out_id = $('#select_outlet').val();
        //table = $('#table-order');
        //console.log(out_id);

        $('#table-order > tbody tr').each(function() {
            var rowID = $(this).attr('id');

            if (rowID == out_id) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    
    function bookingSelectOutlet() {
        out_id = $('#select_booking_outlet').val();
        //table = $('#table-order');
        //console.log(out_id);

        $('#table-booking > tbody tr').each(function() {
            var rowID = $(this).attr('id');

            if (rowID == out_id) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function inventorySelectType() {
        out_id = $('#select_inv_outlet').val();
        type_id = $('#select_inv_type').val();
        //table = $('#table-order');
        //console.log(out_id);

        $('#table-inventory > tbody tr').each(function() {
            var rowID = $(this).attr('id');

            var tID = rowID.split('^')[0];
            var oID = rowID.split('^')[1];

            if (oID == out_id && tID == type_id) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

});
</script>

@endsection