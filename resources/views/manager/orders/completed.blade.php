@extends('manager.base')

@section('content')
<div class=" shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Completed Orders</h6>
    </div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="myTable">
        <thead class="thead-dark" align="center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Food Name</th>
            <th scope="col">Food Cost</th>
            <th scope="col">Ordered At</th>
          </tr>
        </thead>
        <tbody align="center">
            @if ($data != null)
                @foreach($data as $dt)
                <tr class="bg-light" id="{{$dt->id}}">
                    <th scope="row"> {{$dt->id}} </th>
                    <td>{{$dt->cus_name}}</td>
                    <td>{{$dt->cus_contact}}</td>
                    <td>{{$dt->food_name}}</td>
                    <td>{{$dt->food_cost}}</td>
                    <td>{{$dt->created_at}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </div>
</div>
</div>
@endsection