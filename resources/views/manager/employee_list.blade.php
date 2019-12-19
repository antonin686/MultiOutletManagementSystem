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
        <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
    </div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="myTable">
        <thead class="thead-dark" align="center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">CONTACT</th>
            <th scope="col">OPERATIONS</th>
          </tr>
        </thead>
        <tbody align="center">
            @if ($data != null)
                @foreach($data as $dt)
                <tr class="bg-light" id="{{$dt->id}}">
                    <th scope="row"> {{$dt->id}} </th>
                    <td class="profile_view">{{$dt->name}}</td>
                    <td>{{$dt->contact}}</td>
                    <td>
                        <input type="button" name="edit" value="Info" id="{{$dt->id}}" class="btn btn-info emp_info"></input>
                        <input type="button" name="edit" value="Edit" id="{{$dt->id}}" class="btn btn-primary edit_data"></input>
                        <input type="button" name="delete" value="Delete" id="{{$dt->id}}" class="btn btn-danger delete_data"></input>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </div>
</div>
</div>  

{{-- edit modal --}}
<div id="add_data_Modal" class="modal fade">
      <div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>    
                </div>  
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" id="insert_form" action="{{route('updateEmployee')}}">
                                @csrf
                                <label>Name</label>  
                                <input type="text" name="name" id="name" class="form-control" />  
                                <br />  
                                <label>Contact</label>  
                                <input type="text" name="contact" id="contact" class="form-control"></input>  
                                <br />  
                                <label>Salary(Taka)</label>  
                                <input type="text" name="salary" id="salary" class="form-control" />  
                                <br />  
                                <input type="hidden" name="employee_id" id="employee_id" />  
                                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                            </form>  
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header alert alert-primary"style="text-align:center"><strong>Profile Picture</strong></div>
                                <div class="card-body">
                                    <img class="card-img-top" src="" id="img" name="img" alt="..."  height="180" width="300">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>

 {{-- info modal --}}
<div id="info_Modal" class="modal fade">  
        <div class="modal-dialog modal-lg">  
             <div class="modal-content">  
                  <div class="modal-header">  
                      <h4 class="modal-title">Employee Information</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>    
                  </div>  
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-8">
                                  <label>Name</label>  
                                  <input type="text" name="ename" id="ename" class="form-control" readonly />  
                                  <br />  
                                  <label>User Name</label>  
                                  <input type="text" name="eusername" id="eusername" class="form-control" readonly />  
                                  <br /> 
                                  <label>Contact</label>  
                                  <input type="text" name="econtact" id="econtact" class="form-control" readonly/>
                                  <br />  
                                  <label>Salary(Taka)</label>  
                                  <input type="text" name="esalary" id="esalary" class="form-control" readonly/>  
                                  <br /> 
                                  <label>Join Date</label>  
                                  <input type="text" name="edate" id="edate" class="form-control" readonly/>  
                                  <br />  
                                  <input type="hidden" name="employee_id" id="employee_id" readonly/> 
                          </div>
                          <div class="col-md-4">
                              <div class="card">
                                  <div class="card-header alert alert-primary"style="text-align:center"><strong>Profile Picture</strong></div>
                                  <div class="card-body">
                                      <img class="card-img-top" src="" id="eimg" name="img" alt="..."  height="180" width="300">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>  
                  <div class="modal-footer">  
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                  </div>  
             </div>  
        </div>  
   </div>

   {{-- delete modal --}}
   <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5 align="center" style="margin:0;">Are you sure you want to remove this data?</h6>
                </div>
                <div class="modal-footer">
                 <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script >
    $(document).ready( function () {
    $('#myTable').DataTable();


$(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");
           //alert(employee_id);  
           $.ajax({  
                url:"/manager/employeelist/edit", 
                method:"GET",  
                data:{employee_id:employee_id}, 
                dataType:"json",  
                success:function(data){ 
                    //$leads = json_decode($leads, true);
                    //dd($leads);
                     //console.log(data);
                     $('#name').val(data['name']);  
                     $('#contact').val(data['contact']);  
                     $('#salary').val(data['salary']);  
                     $("#img").attr("src", "../".concat(data['img'])); 
                     $('#employee_id').val(data['id']);
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $(document).on('click', '.emp_info', function(){  
           var employee_id = $(this).attr("id");
           //alert(employee_id);  
           $.ajax({  
                url:"/manager/employeelist/info", 
                method:"GET",  
                data:{employee_id:employee_id}, 
                dataType:"json",  
                success:function(data){ 
                    //$leads = json_decode($leads, true);
                    //dd($leads);
                     console.log(data[0]);
                     $('#ename').val(data[0]['name']);  
                     $('#eusername').val(data[0]['username']);  
                     $('#econtact').val(data[0]['contact']);  
                     $('#esalary').val(data[0]['salary']);  
                     $('#edate').val(data[0]['created_at']);  
                     $("#eimg").attr("src", "../".concat(data[0]['img'])); 
                     $('#employee_id').val(data[0]['id']); 
                     $('#info_Modal').modal('show');  
                }  
           });  
      });

    var user_id;

    $(document).on('click', '.delete_data', function(){
    user_id = $(this).attr('id');
    $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
    $.ajax({
    url:"/manager/employeelist/delete/"+user_id,
    beforeSend:function(){
    $('#ok_button').text('Deleting...');
    },
    success:function(data)
    {
    setTimeout(function(){
        $('#confirmModal').modal('hide');
        location.reload();
        alert('Data Deleted');
    }, 2000);
    }
    })
});

});
</script>
@endsection