@extends('manager.base')

@section('content')
<form method="POST" class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.7;background:white">
        <div class="form-group" style="color:black">
            <label>Name</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="name" aria-describedby="e" placeholder="" value="{{$data[0]->mname}}" readonly>
        </div>
        <div class="form-group" style="color:black">
            <label>User Name</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="name" aria-describedby="e" placeholder="" value="{{$data[0]->username}}" readonly>
        </div>
        <div class="form-group" style="color:black">
            <label>Rank</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="rank" aria-describedby="e" placeholder="" value="{{$data[0]->role}}" readonly>
        </div>
        <div class="form-group" style="color:black">
            <label>Contact No.</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="name" aria-describedby="e" placeholder="" value="{{$data[0]->contact}}" readonly>
        </div>
        <div class="form-group" style="color:black">
            <label>Salary</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="salary" aria-describedby="e" placeholder="" value="{{$data[0]->salary}} Tk." readonly>
        </div>
        <div class="form-group" style="color:black">
            <label>Outlet</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="outlet" aria-describedby="e" placeholder="" value="{{$data[0]->out}}" readonly>
            </div>
    </form>  
@endsection