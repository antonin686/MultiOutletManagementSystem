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
<form action="{{route('insertBooking')}}" method="POST">
    <div class="card">
        <div class="card-header alert alert-info" style="text-align:center"><strong>Reserve A Seat</strong></div>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Customer Contact</label>
                <input type="text" class="form-control" id="contact" name="contact">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Number Of Customer(s)</label>
                <input type="text" class="form-control" id="number" name="number">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Arrival Time</label>
                <input type="datetime-local" name="time" id="time" class="form-control">
            </div>
            <div class="form-group">
                <label  for="type">Table No.</label>
                <select class="custom-select" name="table_no">
                    <option value="0"> Select A Table</option>
                    @foreach ($tables as $table)
                    <option value="{{$table->table_id}}">Table - {{$table->table_id}} Seat Count - {{$table->seats}} </option>
                    @endforeach
                </select>    
            </div>
            <div class="form-group">
                <table align="center">
                    <tr>
                        <td>
                            <button type="submit" class="btn btn btn-success btn-lg">Book</button>
                            <a href="/manager/home" class="btn btn-primary btn-lg">Cancel</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection