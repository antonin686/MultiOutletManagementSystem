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
<form method="POST" action="{{route('insertProductType')}}" class="container shadow-lg p-3 mb-5 bg-white rounded" style="opacity:0.9;background:white">
    @csrf
    <div class="form-group">
        <label>Product Type</label>
        <input type="text" class="form-control form-control-lg" id="product_type" name="product_type" aria-describedby="e" placeholder="Enter A New Product Type" value="{{old('type')}}">
    </div>
    <table align="center">
        <tr>
            <td>
                <button type="submit" class="btn btn btn-outline-success">Add This New Product Type</button>
                <a href="/manager/home" class="btn btn-outline-primary">Cancel</a>
            </td>
        </tr>
    </table>
</form>
@endsection