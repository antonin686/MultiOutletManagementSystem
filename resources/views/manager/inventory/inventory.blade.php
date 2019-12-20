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
<form method="POST" class="container shadow-lg p-3 mb-5 bg-white rounded" style="opacity:0.9;background:white">
    @csrf
    <div class="form-group">
        <label>Item Name</label>
        <input type="text" class="form-control" id="name" name="item_name" aria-describedby="e"
            placeholder="Enter Item Name" value="{{old('item_name')}}">
    </div>
    <div class="form-group">
        <label  for="type">Item Type</label>
        <select class="custom-select" name="item_type">
            <option value="0"> Select An Item Type</option>
            @foreach ($type as $tp)
            <option value="{{$tp->type}}"> {{$tp->type}} </option>
            @endforeach
        </select>    
    </div>
    <div class="form-group">
        <label>Item Code</label>
        <input type="text" class="form-control" id="code" name="code"
            aria-describedby="e" placeholder="Enter Item Code" value="">
    </div>
    <div class="form-group">
        <label>Item Cost</label>
        <input type="text" class="form-control" id="cost" name="item_cost"
            aria-describedby="e" placeholder="Enter Item Cost">
    </div>

    <table align="center">
        <tr>
            <td>
                <button type="submit" class="btn btn btn-outline-success">Add Item</button>
                <a href="/manager/home" class="btn btn-outline-primary">Cancel</a>
            </td>
        </tr>
    </table>
</form>
@endsection