@extends('manager.base')

@section('content')
@if (count($errors) > 0)
@foreach ($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach
@endif
<form method="POST" class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white" action="{{route('managerProfile.update')}}">
    @csrf
        <div class="form-group" style="color:black">
            <label>Name</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="name" name="name" aria-describedby="e" placeholder="" value="{{$data[0]->mname}}">
        </div>
        <div class="form-group" style="color:black">
            <label>Contact No.</label>
            <input style="color:black" type="text" class="form-control form-control-lg" id="contact" name="contact" aria-describedby="e" placeholder="" value="{{$data[0]->contact}}">
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