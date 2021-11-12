<html>
<head>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.1/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bulma.min.css">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bulma.min.js"></script>

<style>

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
        table-layout: fixed;
        width: 100px;
      }

td {
        width: 2000px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
    <h2 class ="navbar-item"><strong> Hello,  {{ $user['fname'] }}! </strong>	</h2>
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
<h1 class="title has-text-white is-text-left">Manage Guides</h1>
	<div class="buttons is-right">
	
				<a href="#addUserModal" class="button modal-button is-success " data-target = "#addGuideModal" ><i class="fas fa-plus-square"></i>&nbsp;&nbsp;<span>Add New Guide</span> </a>
				<a href="{{route('logs.list')}}" class="button is-link " ><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp; <span>View History Logs</span></a>
								
	</div>
</div>
   
</section>

	<div class = "container is-fluid has-text-white">								
		<table id="example" class="table is-striped  is-narrow" style="width:100% ">
			<thead>
				<tr>
							<th class="has-text-centered" style=" width: 20px;">ID</th>
							<th>Title</th>
							<th style=" width: 100px;">Category</th>
							<th>Description</th>
							<th style=" width: 100px;">Author</th>
							<th style=" width: 130px;">Created</th>
							<th style=" width: 130px;">Updated</th>
							<th style=" width: 50px;">Actions</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data as $data)
				<tr>
					<td class = "pl-3" style=" width: 25px;">{{$data->id}}</td>
					<td>{{ $data->title}}</td>
					<td>{{ $data->category}}</td>
					<td>{{ $data->description}}</td>
					<td>{{ $data->fname}} {{ $data->lname}}</td>
					<td>{{ $data->created_at}}</td>
					<td>{{ $data->updated_at}}</td>
					<td><a href="#editGuideModal" class="icon has-text-warning modal-button edit" data-id="{{$data->id}}" id="edit" data-target = "#editGuideModal"><i class="fas fa-edit"></i></a>
						<a href="#deleteGuideModal" class="icon has-text-danger modal-button delete1" data-id="{{$data->id}}"  data-target = "#deleteGuideModal"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
			@endforeach				
			</tbody>
			
		</table>					
	</div>



    <!-- Add  Modal HTML -->
    <div id = "addGuideModal" class = "modal">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Add Guide Form</p>	  
					</header>
						<section class="modal-card-body">
							<form action="{{route('guides.add')}}" method="POST">
								@csrf
								<h5 class="title is-5">Title</h5>
							
								<input class="input is-success" name="title" id="title" value="{{ old('title') }}" type="text" placeholder="Input Title" required>
									@error('title')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								<h5 class="title is-5">Category</h5>
									<input class="input is-success" name="category" id="category" value="{{ old('category') }}" type="text" placeholder="Input Category" required>
									@error('category')
								
									<em class="text-danger"> {{ $message }}</em>
								
									@enderror
									<br><br>
								<h5 class="title is-5">Description</h5>
									<input class="input is-success" name="desc" id="desc" value="{{ old('desc') }}" type="text" placeholder="Input Description" required>
									@error('desc')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								<h5 class="title is-5">Content</h5>
									<textarea class="textarea is-success" name="content" id="content" value="{{ old('content') }}"  type="text" placeholder="Input Content" required></textarea>
									@error('content')
								
										<em class="text-danger"> {{ $message }}</em>
										
									@enderror
												
						</section>
					<footer class="modal-card-foot">
						<input type = "submit" class="button is-success" value="Add Guide">
						<input type="button" class="button is-danger modalclose" data-target = "#addGuideModal"  data-dismiss="modal" value="Cancel">
					</form>	
				</div>
					
	</div>
    
    <!-- Edit Modal HTML -->
	<div id = "editGuideModal" class = "modal">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Edit Guide Form</p>	  
					</header>
						<section class="modal-card-body">
							<form action="{{route('guides.update')}}" method="POST">
								@csrf
								<input type="text"  hidden name="id" id="eid" required>
								<h5 class="title is-5">Title</h5>
							
								<input class="input is-success" name="title" id="etitle" value="{{ old('title') }}" type="text" placeholder="Input Title" required>
									@error('title')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								<h5 class="title is-5">Category</h5>
									<input class="input is-success" name="category" id="ecategory" value="{{ old('category') }}" type="text" placeholder="Input Category" required>
									@error('category')
								
									<em class="text-danger"> {{ $message }}</em>
								
									@enderror
									<br><br>
								<h5 class="title is-5">Description</h5>
									<input class="input is-success" name="desc" id="edesc" value="{{ old('desc') }}" type="text" placeholder="Input Description" required>
									@error('desc')
								
									<em class="text-danger"> {{ $message }}</em>
									
									@enderror
									<br><br>
								<h5 class="title is-5">Content</h5>
									<textarea class="textarea is-success" name="content" id="econtent" value="{{ old('content') }}"  type="text" placeholder="Input Content" required></textarea>
									@error('content')
								
										<em class="text-danger"> {{ $message }}</em>
										
									@enderror
											
						</section>
					<footer class="modal-card-foot">
						<input type="submit" class="button is-success" value="Save Changes">
						<input type="button" class="button is-danger modalclose"  data-dismiss="modal" value="Cancel">
					</footer>
					</form>	
				</div>
					
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteGuideModal" class="modal">
		<div class="modal-background"></div>
			<div class="modal-card">
				<form action="{{route('guides.delete')}}" method="POST">
				@csrf
				@method('DELETE')
				
										
						<header class="modal-card-head">
							<p class="modal-card-title">Delete Guide</p>	  
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
  $(document).ready(function() {
    $('#example').DataTable();
} );

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
	
	var guide_id = $(this).data('id');
	
	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
	$("#eid").val(data.details.id);
	$("#etitle").val(data.details.title);
	$("#ecategory").val(data.details.category);
	$("#edesc").val(data.details.description);
	$("#econtent").val(data.details.content);
	},'json');

 
})


$(document).on('click','.delete1',function(){
	var guide_id = $(this).data('id');
	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
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