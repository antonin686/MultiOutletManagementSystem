@extends('manager.base')

@section('booking')
<form action="{{route('insertBooking')}}" method="POST">
    <div class="row">
            <div class="col-md-4 form-control-sm">
                <div class="card">
                    <div class="card-header alert alert-info" style="text-align:center"><strong>Reserve A Table</strong></div>
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
            </div>
</form>
    <div class="col-md-8 form-control-sm">
        <div class="card">
            <div class="card-header alert alert-info" style="text-align:center"><strong>Reserved Tables</strong></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead class="thead-dark" align="center">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">CUSTOMER NAME</th>
                            <th scope="col">CONTACT</th>
                            <th scope="col">TOTAL CUSTOMERS</th>
                            <th scope="col">TABLE NO.</th>
                            <th scope="col">OPERATIONS</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection