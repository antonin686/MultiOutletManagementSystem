@extends('admin.layout')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="{{ route('admin.tables') }}">Tables</a></li>
<li class="breadcrumb-item active" aria-current="page">Employee Profile</li>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-category">Complete Employee Profile</p>
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
                                <label class="bmd-label-floating">Username</label>
                                <input type="text" value="{{$user->username}}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name" value="{{$user->emp_name}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Contact</label>
                                <input type="text" name="contact" value="{{$user->contact}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Salary</label>
                                <input type="text" name="salary" value="{{$user->salary}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>About Me</label>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$user->about}} </label>
                                    <textarea class="form-control" name="about" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <button type="button" class="btn btn-danger btn-round" data-toggle="modal"
                        data-target="#deleteModal">
                        Delete Profile
                    </button>


                    <button type="submit" class="btn btn-primary btn-round pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#">
                    <img class="img" src="{{$user->img}}" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray">{{$user->role_name}}</h6>
                <h4 class="card-title">{{$user->emp_name}}</h4>
                <p class="card-description">
                    {{$user->about}}
                </p>
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
                Are you sure you want to delete this profile?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="{{ route('employee.destroy', ['id' => $user->id]) }}">Yes</a>
            </div>
        </div>
    </div>
</div>
@endsection