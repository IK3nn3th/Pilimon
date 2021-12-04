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
<!-- Datatable HTML -->
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
		"order": [[ 4, "desc" ]],
		responsive: true,
		columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2},
        { responsivePriority: 3},
        { responsivePriority: 4},
        { responsivePriority: 5},
        { responsivePriority: 6},

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
table.dataTable>tbody>tr.child ul.dtr-details>li{
  white-space: break-spaces;

}
 

  .pagination-link, .pagination-next, .pagination-previous {
    background-color:#fff;
    border-color: #000;
    color: #363636;
  
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
    <h2 class ="navbar-item"><strong> Hello,  {{ $user['fname'] }}! </strong> </h2>
    @if(Auth::user()->role==2)
      <a class="navbar-item" href="{{route('manager.dashboard')}}">
        <span class="icon-text">
            <span class="icon">
                <i class="fas fa-home"></i>
            </span>
            <strong>Home</strong>
        </span>
      </a>
    @elseif(Auth::user()->role==1)
    <a class="navbar-item" href="{{route('admin.dashboard')}}">
          <span class="icon-text">
              <span class="icon">
                  <i class="fas fa-home"></i>
              </span>
              <strong>Home</strong>
          </span>
        </a>
    @endif
    @if(Auth::user()->role==1)
	<a class="navbar-item" href="{{route('manager.dashboard')}}">
		<span class="icon-text">
				<span class="icon">
				<i class="material-icons">library_add</i>
				</span>
				<strong>Manage Guides</strong>
		</span> 
    </a>
	@else
      <a class="navbar-item" href="{{route('user.dashboard')}}">
		<span class="icon-text">
				<span class="icon">
				<i class="fas fa-book"></i>
				</span>
				<strong>View Guides</strong>
		</span> 
      </a>
	@endif
	@if(Auth::user()->role==1)
    <a class="navbar-item" href="{{route('user.dashboard')}}">
			<span class="icon-text">
					<span class="icon">
          <i class="fas fa-book"></i>
					</span>
					<strong>View Guides</strong>
			</span> 
		</a>
    @endif
    <a class="navbar-item modal-button" href="#Changepassword" data-target="#Changepassword">
        <span class="icon-text">
            <span class="icon">
            <i class="fas fa-key"></i>
            </span>
            <strong>Change Password</strong>
        </span> 
      
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a href="{{ route('logout') }}" class="button is-danger" onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											 <span class="icon-text">
													<span class="icon">
													<i class="material-icons">logout</i>
													</span>
													<strong>Log out </strong>
												</span> 
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf 
						</form></a>
            
         
        </div>
      </div>
    </div>
  </div>
</nav>
<section class="section">

<div class=" ">
<h1 class="title has-text-white is-text-left">History Logs</h1>
</div>
   
</section>
<div class = "container is-fluid has-text-white">
            <table class="table  is-striped nowrap is-narrow" id = "example" style="width:100%" >
            <thead>
                    <tr>
                        <th class="has-text-centered" style=" width: 20px;">ID</th>
                        <th style=" width: 100px;">Name</th>	
                        <th style=" width: 70px;">Action</th>
                        <th>Actions made:</th>
                        <th style=" width: 150px;">Performed on</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td class = "has-text-centered" style=" width: 25px;">{{$data->id}}</td>
                        <td>{{ $data->fname}} {{ $data->lname}}</td>
                        <td>{{ $data->Action}}</td>
                        <td>{{ $data->Content}}</td>
                        <td>{{ $data->created_at}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div>
        </div>    
    </div>

</div>

  


 <!-- Change password modal -->
 <div id = "Changepassword" class = "modal changepass" id="changepass">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Change Password</p>	  
					</header>
						<section class="modal-card-body">
							<form action="{{route('change.pass')}}" method="POST">
								@csrf
								<h5 class="title is-5">Current Password</h5>
								<input class="input is-success" name="Currentpass" id="Currentpass" value="{{ old('Currentpass') }}" type="password" placeholder="Current Password" required>
								<br>	<br>
								<h5 class="title is-5">New Password</h5>
								<input class="input is-success" name="Newpass" id="Newpass" value="{{ old('Newpass') }}" type="password" placeholder="New Password" required>
								<br>	<br>
								<h5 class="title is-5">Confirm New Password</h5>
								<input class="input is-success" name="ConfirmPass" id="ConfirmPass" value="{{ old('ConfirmPass') }}" type="password" placeholder="Confirm New Password" required>
								<span class= "text-danger">{{session('error')}}</span>
						</section>
					<footer class="modal-card-foot">
						<input type = "submit" class="button is-success" value="Change Password">
						<input type="button" class="button is-danger modalclose" data-target = "#addUserModal"  data-dismiss="modal" value="Cancel">
					</form>	
				</div>
					
	</div>
	
@if(!empty(session('error'))){
<script>
$(document).ready(function() {
	$("html").addClass("is-clipped");
	$(".changepass").addClass("is-active");
});
</script>

}
@endif
		






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


$(".modal-button").click(function() {
          
          var target = $(this).data("target");
                    $("html").addClass("is-clipped");
                    $(target).addClass("is-active");
                
                 });
                 
             $(".modalclose").click(function() {
                 
                    $(".modal").removeClass("is-active");
                 });
        </script>
        
</script>
</body>
</html>
