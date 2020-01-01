@extends('manager.base')

@section('content')
    <div class="row shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white">
            <div class="col-md-4">
                    <div class="card-header alert alert-primary">Load Attendance</div>
                    <form action="{{route('loadAttendance')}}" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select An Employee</label>
                            <select class="custom-select" name="emp_name">
                                <option value="0"> Select An Employee</option>
                                @foreach ($data as $dt)
                                <option value="{{$dt->emp_name}}">{{$dt->emp_name}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div class="card-footer">
                            <table align="center">
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn btn-outline-success" id="checkBtn">Load</button>
                                        <a href="/manager/home" class="btn btn-outline-primary">Cancel</a>
                                        <br>
                                        @if (count($errors) > 0)
                                        @foreach ($errors->all() as $error)
                                            <p class="alert alert-danger">{{$error}}</p>
                                        @endforeach
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
                </div>
        <div class="col-md-8">
            <div class="card-header alert alert-primary">Attendance List</div>
            @if ($info == null)
            <div class="card-header alert alert-warning">No Name Selected</div>
            @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead class="thead-dark" align="center">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">DATE</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach($info as $dt)
                            <tr class="bg-light" id="{{$dt->id}}">
                                <th scope="row"> {{$dt->id}} </th>
                                <td>{{($dt->created_at)->toDateString()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection 

@section('script')
<script >
    $(document).ready( function () {
    $('#myTable').DataTable();
});
</script>
@endsection