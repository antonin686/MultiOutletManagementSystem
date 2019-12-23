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
 <form method="POST" class="container shadow-lg p-3 mb-5 bg-blue rounded" style="opacity:0.9;background:white"
     action="{{route('addEmployee')}}" enctype="multipart/form-data">
     @csrf
     <div class="form-group">
         <label for="exampleInputName1">Name</label>
         <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" aria-describedby=""
             placeholder="Name">
     </div>
     <div class="form-group">
         <label for="exampleInputName1">User Name</label>
         <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}"
             aria-describedby="" placeholder="User Name">
     </div>
     <div class="form-group">
         <label for="exampleInputName1">Contact No.</label>
         <input type="text" class="form-control" id="contact" name="contact" value="{{old('contact')}}"
             aria-describedby="" placeholder="Contact No.">
     </div>
     <div class="form-group">
         <label for="exampleInputName1">Salary</label>
         <input type="text" class="form-control" id="salary" name="salary" value="{{old('salary')}}" aria-describedby=""
             placeholder="Salary">
     </div>
     <div class="form-group">
         <label for="exampleInputPassword1">Password</label>
         <input type="password" class="form-control" id="password" name="password" placeholder="Password">
     </div>
     <div class="form-group">
         <label for="exampleInputPassword1">Profile Picture</label><br>
         <input type="file" id="file" name="file">
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