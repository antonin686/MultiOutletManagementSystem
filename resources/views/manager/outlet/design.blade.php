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
<form method="POST" class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white" action="{{route('insert')}}">
   @csrf
       <div class="form-group">
               <label for="exampleInputName1">Table Name</label>
               <input type="text" class="form-control" id="name" name="name" value="Table - {{$counter}}" aria-describedby="" readonly>
       </div>
       <div class="form-group">
           <label for="exampleInputName1">Number Of Seast</label>
           <input type="text" class="form-control" id="seats" name="seats" aria-describedby="" placeholder="Number Of Seats">
       </div>
       <div class="form-group">
               <table align="center">
                   <tr>
                       <td>
                           <button type="submit" class="btn btn btn-success btn-lg">Create</button>
                           <a href="/manager/home" class="btn btn-primary btn-lg">Cancel</a>
                       </td>
                   </tr>
               </table>
           </div>
</form>
@endsection