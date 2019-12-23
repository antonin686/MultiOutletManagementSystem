@extends('admin.layout')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="{{ route('admin.tables') }}">Tables</a></li>
<li class="breadcrumb-item active" aria-current="page">Outlet Profile</li>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Outlet Profile</h4>
                <p class="card-category">Complete Outlet Profile</p>
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

                <form method="POST">
                    @csrf
                    <div class="col">
                        <div class="col-md-5 mx-auto">
                            <div class="form-group">
                                <label class="bmd-label-floating">Company</label>
                                <input type="text" class="form-control" value="Multi-Outlet" disabled>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Outlet Name</label>
                                <input type="text" name="name" value="{{ $outlet->out_name }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Location</label>
                                <input type="text" name="location" value="{{ $outlet->location }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">City</label>
                                <input type="text" name="city" value="{{ $outlet->city }}" class="form-control">
                            </div>
                        </div>
                    </div>


                    <button type="button" class="btn btn-danger btn-round" data-toggle="modal"
                        data-target="#deleteModal">
                        Delete Outlet
                    </button>

                    <button type="submit" class="btn btn-primary btn-round pull-right">Update Outlet</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">Employees</h4>

            </div>
            <div class="card-body">
                <div class="card-body table-responsive">
                    <table id="table-employee" class="table table-hover">
                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Username</th>
                            <th>Salary</th>
                            <th>Role</th>
                        </thead>
                        <tbody>
                            @foreach($emps as $emp)
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
    </div>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Outlet?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="{{ route('outlet.destroy', ['id' => $outlet->id]) }}">Yes</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(() => {

    $('#table-employee').DataTable();

    $('#table-employee').on('click', 'tr', (event) => {

        var id = $(event.currentTarget).attr("id");

        if (id != null) {
            window.location.href = `/admin/employee/show/${id}`;
        }
    });

});
</script>
@endsection