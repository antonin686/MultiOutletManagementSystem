@extends('manager.base')

@section('content')
<div class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white">
    <div class="form-group" style="color:black">
        <label>Outlet Name</label>
        <input style="color:black" type="text" class="form-control form-control-lg" id="name" aria-describedby="e" placeholder="" value="{{$data[0]->name}}" readonly>
    </div>
    <div class="form-group" style="color:black">
        <label>Outlet Location</label>
        <input style="color:black" type="text" class="form-control form-control-lg" id="name" aria-describedby="e" placeholder="" value="{{$data[0]->location}}" readonly>
    </div>
    <div class="form-group" style="color:black">
        <label>City</label>
        <input style="color:black" type="text" class="form-control form-control-lg" id="city" aria-describedby="e" placeholder="" value="{{$data[0]->city}}" readonly>
    </div>
</div>  
@endsection