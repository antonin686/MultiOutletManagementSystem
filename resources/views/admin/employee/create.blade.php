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
                <form method="POST">
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
                                <input type="text" name="username" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="password" value="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name" value="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="bmd-label-floating">Contact</label>
                                <input type="text" name="contact" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select class="form-control selectpicker" data-style="btn btn-link"
                                id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
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