@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.tables') }}">Tables</a></li>
<li class="breadcrumb-item active" aria-current="page">Create Outlet</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Outlet Profile</h4>

                <p class="card-category">Create Outlet Profile</p>

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

                <form method="POST">
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
                                <label class="bmd-label-floating">Outlet Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Location</label>
                                <input type="text" name="location" value="{{old('location')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">City</label>
                                <input type="text" name="city" value="{{old('city')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tables</label>
                                <input type="text" name="table" value="{{old('table')}}" class="form-control">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-round pull-right">Create Outlet</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection