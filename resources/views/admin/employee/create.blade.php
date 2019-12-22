@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.tables') }}">Tables</a></li>
<li class="breadcrumb-item active" aria-current="page">Create Employee</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Employee Profile</h4>

                <p class="card-category">Create Employee Profile</p>

            </div>
            <div class="card-body ">
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

                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">Company</label>
                                <input type="text" class="form-control" value="Multi-Outlet" disabled>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Username</label>
                                <input type="text" name="username" value="{{old('username')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="password" name="password"value="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name"  value="{{old('name')}}" class="form-control">
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
                                <label class="bmd-label-floating">Salary</label>
                                <input type="text" name="salary" value="{{old('salary')}}" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="out_id">Outlet</label>
                                <select class="custom-select" name="out_id">
                                    @foreach($outlets as $outlet)
                                    <option value="{{$outlet->id}}">{{$outlet->out_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="custom-select" name="role">
                                    <option value="2">Manager</option>
                                    <option value="3">Seller</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label for="img">Upload Image</label>
                            <div class="input-group">
                                <input type="file" name="img" id="img">
                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-round pull-right">Create Profile</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection