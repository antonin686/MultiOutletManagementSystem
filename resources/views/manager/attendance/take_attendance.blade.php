@extends('manager.base')

@section('content')

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach
@endif

@if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif
<div class=" shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Take Attendance</h6>
    </div>
<form action="{{route('insertAttendance')}}" method="POST">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="myTable">
        <thead class="thead-dark" align="center">
            <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">CONTACT</th>
            <th scope="col">TAKE ATTENDANCE</th>
            </tr>
        </thead>
        <tbody align="center">
            @if ($data != null)
                @foreach($data as $dt)
                <tr class="bg-light" id="{{$dt->id}}">
                    <th scope="row"> {{$dt->id}} </th>
                    <td class="profile_view">{{$dt->emp_name}}</td>
                    <td>{{$dt->contact}}</td>
                    <td>
                        <input type="checkbox" class="form-check-input" id="{{$dt->id}}" name="checkbox[]" value="{{$dt->id}}">
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
        </table>
        <div>
        <table align="center">
            <tr>
                <td>
                    <button type="submit" class="btn btn btn-outline-success" id="checkBtn">Take Attendance</button>
                    <a href="/manager/home" class="btn btn-outline-primary">Cancel</a>
                </td>
            </tr>
        </table>
    </div>
    </div>
</div>
</div>
</form>
  
@endsection