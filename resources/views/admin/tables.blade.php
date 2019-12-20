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
                                <a class="nav-link" href="#settings" data-toggle="tab">
                                    <i class="material-icons">fastfood</i> Order
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#settings" data-toggle="tab">
                                    <i class="material-icons">import_contacts</i> Booking
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
                                    <tr>
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

                    <div class="tab-pane" id="settings">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(() => {

    $('#table-employee').DataTable();
    $('#table-outlet').DataTable();


    $('#employee').on('click', 'tr', (event) => {

        var id = $(event.currentTarget).attr("id");

        if (id != null) {
            window.location.href = `/admin/employee/${id}`;
        }
    });
});
</script>

@endsection