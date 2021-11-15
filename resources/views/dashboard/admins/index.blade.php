<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

<!-- Modal HTML -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Bulma CSS -->	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<!-- Fontawesome-->
<script src="https://kit.fontawesome.com/3b6fb5d974.js" crossorigin="anonymous"></script>
<!-- Material Icons-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Javascript-->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- Datatable-->
 
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bulma.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	
	
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bulma.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" class="init">
	$(document).ready(function() {
	var table = $('#example').DataTable( {
		
		responsive: true,
		columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ]
	} );
} );

</script>
<style>
#example_info,
label{
color:white;
}

div.dataTables_wrapper div.dataTables_filter input{
	margin-bottom:1.0em;
}
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_paginate .paginate_button
{
background-color:white;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{

  border:black;
  background:#3273dc;
}
html,
body{
		
		background-color: #234D20;
        position: relative;
        min-height: 100vh
       
}
.button{
		color:#fff;
		background: #77AB59;
}
.title h1{
	color: #C9DF8A;
	
}
.bm--card-equal-height {
   display: flex;
   flex-direction: column;
   height: 100%;
}
.bm--card-equal-height .card-footer {
   margin-top: auto;
}
.footer-size{
background-color:#E7E6DA;
padding: 10px 10px 10px;
position: absolute;
  bottom: 0;
  width: 100%;
}
.guide{
background-color:#A2AF9F;
}
.navbarcolor{
background-color:#D6F4FF;
}
.category{
background-color:#E7E6DA;
}
table {
     
	   margin-top: 25px;
        
      }

</style>

<title>Pilimon</title>

</head>
<body  class=" has-navbar-fixed-top">
<nav class="navbar is-fixed-top navbarcolor" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
  @if(Auth::user()->role==2)
    <a class="navbar-item" href="{{route('manager.dashboard')}}">
      <img src="/images/P.png">
    </a>
  @elseif(Auth::user()->role==3)
  <a class="navbar-item" href="{{route('user.dashboard')}}">
      <img src="/images/P.png">
    </a>
	@elseif(Auth::user()->role==1)
  	<a class="navbar-item" href="{{route('admin.dashboard')}}">
      <img src="/images/P.png">
    </a>
  @endif
    <a role="button" class="navbar-burger " aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu  ">
    <div class="navbar-start">
		<h2 class ="navbar-item"><strong> Hello,  {{ $name['fname'] }}! </strong>	</h2>
		<a class="navbar-item" href="{{route('admin.dashboard')}}">
			<span class="icon-text">
				<span class="icon">
					<i class="fas fa-home"></i>
				</span>
				<strong>Home</strong>
			</span>
		</a>

		<a class="navbar-item" href="{{route('manager.dashboard')}}">
			<span class="icon-text">
					<span class="icon">
					<i class="material-icons">library_add</i>
					</span>
					
					<strong>Manage Guides</strong>
			</span> 
		</a>

		<a class="navbar-item" href="{{route('user.dashboard')}}">
			<span class="icon-text">
					<span class="icon">
					<i class="fas fa-book"></i>
					</span>
					<strong>View Guides</strong>
			</span> 
		</a>
    </div>

		<div class="navbar-end">
			<div class="navbar-item">
				<div class="buttons">
				<a href="{{ route('logout') }}" class="button is-danger" onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">
													{{ __('Logout') }}
												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf 
								</form></a>
					
				
				</div>
			</div>
		</div>
  	</div>
</nav>

<section class="section">

<div class="">
<h1 class="title is-size-4-mobile has-text-white is-text-left-desktop ">Manage User Accounts</h1>
	<div class="buttons are-small-mobile is-centered ">
	
				<a href="#addUserModal" class="button modal-button is-success   is-fullwidth " data-target = "#addUserModal" >
				<span class="icon-text">
					<span class="icon">
					<i class="material-icons">person_add_alt_1</i>
					</span>
					
					&nbsp;<span>Add New User</span>
				</span></a>
				<a href="{{route('logs.list')}}" class="button is-link  is-fullwidth" ><i class="fas fa-clipboard-list"></i>&nbsp; <span>View History Logs</span></a>
								
	</div>
</div>
   
</section>
<section class="section has-text-white">								
		<table id="example" class=" table is-striped " style="width:100%;">
	
		<thead>
				<tr>
							<th class="pl-5 has-text-centered" style=" width:25px;">ID</th>
							<th class ="ml-3" style=" width:25px;">Name</th>
							<th style=" width: 100px;">Email Address</th>
							<th class="has-text-centered" style=" width: 20px;">Role</th>
							<th style=" width: 30px;">Status</th>
							<th style=" width: 120px;">Created</th>
							<th style=" width: 120px;">Updated</th>
							<th style=" width: 30px;">Actions</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
				<tr>
					<td class = "has-text-centered" style=" width: 25px;">{{$user->id}}</td>
					<td class ="ml-3">{{ $user->fname}} {{ $user->lname}}</td>
					<td>{{ $user->email}}</td>
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
					<td>{{ $user->created_at}}</td>
					<td>{{ $user->updated_at}}</td>
					<td><a href="#editUserModal" class="icon has-text-warning modal-button edit" data-id="{{$user->id}}" id="edit" data-target = "#editUserModal"><i class="fas fa-edit"></i></a>
						<a href="#deleteUserModal" class="icon has-text-danger modal-button delete1" data-id="{{$user->id}}"  data-target = "#deleteUserModal"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
			@endforeach				
			</tbody>
			
		</table>					
	</div>
</section>



    <!-- Add  Modal HTML -->
    <div id = "addUserModal" class = "modal">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Add User Form</p>	  
					</header>
						<section class="modal-card-body">
							<form action="/admin/adduser" method="POST">
								@csrf
								<div class="columns">
									<div class="column is-6">
										<h5 class="title is-5">First Name</h5>
										<input class="input is-success" name="fname" id="fname" value="{{ old('fname') }}" type="text" placeholder="First Name" required>
											@error('fname')
										
											<em class="text-danger"> {{ $message }}</em>
											
											@enderror
									</div>
									<div class="column is-6">
										<h5 class="title is-5">Last Name</h5>
										<input class="input is-success" name="lname" id="lname" value="{{ old('lname') }}" type="text" placeholder="Last Name" required>
											@error('lname')
										
											<em class="text-danger"> {{ $message }}</em>
											
											@enderror
									</div>
								</div>
								<h5 class="title is-5">Email Address</h5>
								<input class="input is-success" name="email" id="email" value="{{ old('email') }}" type="text" placeholder="Email Address" required>
									@error('email')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								<h5 class="title is-5">Password</h5>
								<input class="input is-success" name="password" id="password" value="{{ old('password') }}" type="password" placeholder="Password" required>
									@error('pass')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>


								<div class="columns">
									<div class="column is-6">
										<div class="field ">
											<h5 class="title is-5 ">Role</h5>
												<div class="control is-expanded">
													<div class="select is-success" >
														<select name="role" id="role" value="{{ old('role') }}" type="text" required>
															<option>Select dropdown</option>
															<option value="3">Student</option>
															<option value="2">Manager</option>
															<option value="1">Admin</option>
														</select>
													</div>
												</div>
										@error('role')
									
										<em class="text-danger"> {{ $message }}</em>
									
										@enderror
										</div>
									</div>
									<div class="column is-6">
										<div class="field ">
												<h5 class="title is-5 ">Status</h5>
													<div class="control is-expanded">
														<div class="select is-success" >
															<select name="status" id="status" value="{{ old('status') }}" type="text"  required>
																<option>Select dropdown</option>
																<option value="active">Active</option>
																<option value="inactive">Inactive</option>						
															</select>
														</div>
													</div>
											@error('status')
										
											<em class="text-danger"> {{ $message }}</em>
										
											@enderror
										</div>
									</div>
								</div>
										
						</section>
					<footer class="modal-card-foot">
						<input type = "submit" class="button is-success" value="Add User">
						<input type="button" class="button is-danger modalclose" data-target = "#addUserModal"  data-dismiss="modal" value="Cancel">
					</form>	
				</div>
					
	</div>
    
    <!-- Edit Modal HTML -->
	<div id = "editUserModal" class = "modal">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Edit User Form</p>	  
					</header>
						<section class="modal-card-body">
							<form action="{{route('edit.user')}}" method="POST">
								@csrf
								<input type="text"  hidden name="id" id="editid" required>
								<div class="columns">
									<div class="column is-6">
										<h5 class="title is-5">First Name</h5>
										<input class="input is-success" name="fname" id="editfname" value="{{ old('fname') }}" type="text" placeholder="First Name" required>
											@error('fname')
										
											<em class="text-danger"> {{ $message }}</em>
											
											@enderror
									</div>
									<div class="column is-6">
										<h5 class="title is-5">Last Name</h5>
										<input class="input is-success" name="lname" id="editlname" value="{{ old('lname') }}" type="text" placeholder="Last Name" required>
											@error('lname')
										
											<em class="text-danger"> {{ $message }}</em>
											
											@enderror
									</div>
								</div>
								<h5 class="title is-5">Email Address</h5>
								<input class="input is-success" name="email" id="editemail" value="{{ old('email') }}" type="text" placeholder="Email Address" required>
									@error('email')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								


								<div class="columns">
									<div class="column is-6">
										<div class="field ">
											<h5 class="title is-5 ">Role</h5>
												<div class="control is-expanded">
													<div class="select is-success" >
														<select name="role" id="editrole" value="{{ old('role') }}" type="text" required>
															<option>Select dropdown</option>
															<option value="3">Student</option>
															<option value="2">Manager</option>
															<option value="1">Admin</option>
														</select>
													</div>
												</div>
										@error('role')
									
										<em class="text-danger"> {{ $message }}</em>
									
										@enderror
										</div>
									</div>
									<div class="column is-6">
										<div class="field ">
												<h5 class="title is-5 ">Status</h5>
													<div class="control is-expanded">
														<div class="select is-success" >
															<select name="status" id="editstatus" value="{{ old('status') }}" type="text"  required>
																<option>Select dropdown</option>
																<option value="active">Active</option>
																<option value="inactive">Inactive</option>						
															</select>
														</div>
													</div>
											@error('status')
										
											<em class="text-danger"> {{ $message }}</em>
										
											@enderror
										</div>
									</div>
								</div>
										
						</section>
					<footer class="modal-card-foot">
						<input type = "submit" class="button is-success" value="Save Changes">
						<input type="button" class="button is-danger modalclose" data-target = "#editUserModal"  data-dismiss="modal" value="Cancel">
					</form>	
				</div>
					
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteUserModal" class="modal">
		<div class="modal-background"></div>
			<div class="modal-card">
				<form action="{{route('delete.user')}}" method="POST">
				@csrf
				@method('DELETE')
				
										
						<header class="modal-card-head">
							<p class="modal-card-title">Delete User Information</p>	  
						</header>
						<input type="text"  hidden name="id" id="deleteID" required></input>
						<section class="modal-card-body">
							<p>Are you sure you want to delete these Records?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
						</section>
					<footer class="modal-card-foot">
						<input input type="button" class="button is-light has-text-black modalclose" data-dismiss="modal" value="Cancel">
						<input type="submit" class="button is-danger" value ="Delete">
					</footer>
				</form>
				
			</div>
	</div>






<script type="text/javascript">

$(".modal-button").click(function() {
          
	var target = $(this).data("target");
            $("html").addClass("is-clipped");
            $(target).addClass("is-active");
        
         });
         
		 $(".modalclose").click(function() {
         
            $(".modal").removeClass("is-active");
         });
</script>


<script>
$(document).on('click','.edit',function(){
	
	var user_id = $(this).data('id');

	$.get("{{ route('get.user')}}" ,{user_id},function(data){
	$("#editid").val(data.details.id);	
	$("#editfname").val(data.details.fname);
	$("#editlname").val(data.details.lname);
	$("#editemail").val(data.details.email);
	$("#editrole").val(data.details.role);
	$("#editstatus").val(data.details.status);
	},'json');
 
})
$(document).on('click','.delete1',function(){
	
	var user_id = $(this).data('id');

	$.get("{{ route('get.user')}}" ,{user_id},function(data){
	$("#deleteID").val(data.details.id);
	
	},'json');
 
})
</script>
<br><br><br><br><br><br>
<footer class="footer footer-size">
 
    <p class="content has-text-centered">
      <strong>PILIMON</strong> by Eleazar Ines, Axcell Pontiga, Edric Belando. In Partial Fulfillment of the Requirements for the Degree of
Bachelor of Science in Information Technology
 
    </p>
  </div>
</footer>
<script>
$(document).ready(function() {
  // Check for click events on the navbar burger icon
  $(".navbar-burger").click(function() {
      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      $(".navbar-burger").toggleClass("is-active");
      $(".navbar-menu").toggleClass("is-active");
	
  });
	 $(".navbar-link").click(function() {
   
	$(".navbar-dropdown").toggleClass("is-hidden");
  });
	
});
</script>
</body>
</html>