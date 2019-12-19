@extends('manager.base')

@section('content')

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach
@endif

@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif

<form method="POST" class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white" action="{{route('managerProfile.password')}}">
    @csrf
        <div class="form-group" style="color:black">
            <label>Enter Current Password</label>
            <input style="color:black" type="password" class="form-control form-control-lg" id="oldpass" name="current_password" aria-describedby="e" placeholder="Enter Current Password" value="{{old('current_password')}}">
        </div>
        <div class="form-group" style="color:black">
            <label>Enter New Password</label>
            <input style="color:black" type="password" class="form-control form-control-lg" id="newpass" name="password" aria-describedby="e" placeholder="Enter New Password" value="">
        </div>
        <div class="form-group" style="color:black">
            <label>Re-Enter New Password</label>
            <input style="color:black" type="password" class="form-control form-control-lg" id="repass" name="password_confirmation" aria-describedby="e" placeholder="Re-Enter New Password" value="">
        </div>
        <div class="form-group">
            <table align="center">
                <tr>
                    <td>
                        <button type="submit" class="btn btn btn-success btn-lg">Save</button>
                        <a href="/manager/home" class="btn btn-primary btn-lg">Cancel</a>
                    </td>
                </tr>
            </table>
        </div>
    </form> 
@endsection