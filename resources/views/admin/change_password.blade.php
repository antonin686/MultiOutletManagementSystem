@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Change Password</li>
@endsection

@section('content')

<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Change Password</h4>
        </div>
        <div class="card-body">
            <div class="col-md-10 mx-auto">
            
            <form method="POST">
            @csrf
                <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" name="old" class="form-control" id="oldPassword" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password"name="new" class="form-control" id="newPassword" placeholder="">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection