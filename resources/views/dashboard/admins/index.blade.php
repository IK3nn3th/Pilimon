@extends('layouts.adminLayout')
@section('content')


	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2> <b>Manage Accounts</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
												
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover" id ="datatable">
					<thead>
						<tr>
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email Address</th>
							<th>Role</th>
							<th>Status</th>
						</tr>
						@foreach($users as $user)
							 <tr>
								<td>{{$user->id}}</td>
								<td>{{$user->fname}}</td>
								<td>{{$user->lname}}</td>
								<td>{{$user->email}}</td>
							@switch($user->role)
								@case(1)
								<td>Admin</td>
								@break
								@case(2)
								<td>Manager</td>
								@break
								@case(3)
								<td>Student</td>
								@break
							@endswitch
							
													
								<td>{{$user->status}}</td>
								<td><a href="" class="edit" id="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
								</td>	

							</tr>
						@endforeach
					</thead>
					<tbody>
					
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>        
    
	<!-- Add Modal HTML -->
	<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="/admin/adduser" method="POST">
				@csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add User Form</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					@include('dashboard.admins.form')
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
				@if (count($errors) > 0)
 				   <script type="text/javascript">
				        $( document ).ready(function() {
 				            $('#addUserModal').modal('show');
 				       });
				    </script>
				@endif
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action ="/admin/edituser" method="POST">
				@csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<input type="text"  hidden name="id" id="editid" required>
					<table class="table table-striped"> 	
					<tr>
					<td colspan = "2">
						<div class="form-group">
							<label>Email Address</label>
							<input type="email" name="email" id="editemail" class="form-control " required>
							@error('email')
                   			
							<em class="text-danger"> {{ $message }}</em>
                  			 
              			  	@enderror
						</div>
					</td>
					
					
					</tr>
					<tr>
					<td>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" id="editfname" name="fname" value="{{ old('lname') }}" required>
							@error('fname')
                   			 
							<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
           
						</div>
					</td>
					
					<td>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" id="editlname" name="lname" value="{{ old('lname') }}" required>
							@error('lname')
                   			 
                    		<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
						</div>
					</td>
					</tr>
					
					<tr>
                    <td>
						<div class="form-group">
							<label>Role</label>
							<br>
							<select name="role" id="editrole" class="form-control" required>
								<option value="3">Student</option>
								<option value="1">Administrator</option>
								<option value="2">Manager</option>
						
							</select>
						</div>
					</td>
					<td>
						<div class="form-group">
							<label>Status</label>
							<br>
							<select name="status" id="editstatus" class="form-control" required>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
							 </select>
						</div>
					</td>
					<td>
					</td>
					<td>
					</td>
					</tr>
					</table>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save Changes">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="/admin/delete" method="POST">
				@csrf
				@method('DELETE')
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<input type="text"  hidden name="id" id="deleteID" required>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>

<script>
$(document).ready(function(){
	// code to read selected table row cell data (values).
	$(".delete").on('click',function(){
		 var currentRow=$(this).closest("tr");
		 var id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value	
	
		$("#deleteID").val(id);	
        
		 $('#deleteEmployeeModal').modal('show');
		
	});
});
</script>

<script>
$(document).ready(function(){
	// code to read selected table row cell data (values).
	$(".edit").on('click',function(){
		 var currentRow=$(this).closest("tr");
		 var id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
         var col1=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
         var col2=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
		 var col3=currentRow.find("td:eq(3)").text(); // get current row 3rd TD
		 var col4=currentRow.find("td:eq(4)").text(); // get current row 3rd TD
		 var col5=currentRow.find("td:eq(5)").text(); // get current row 3rd TD
		 switch(col4) {
			  case "Admin":
				col4 = 1;
			    break;
			  case "Manager":
				col4 = 2;
			    break;
			case "Student":
				col4 = 3;
				break
			  default:
				alert("wrong role");
			}
		 $("#editid").val(id);	
         $("#editfname").val(col1);
		 $("#editlname").val(col2);
		 $("#editemail").val(col3);
		 $("#editrole").val(col4);
		 $("#editstatus").val(col5);
		 
		
		$('#editUserModal').modal('show');
		
	});
});
</script>

@endsection

