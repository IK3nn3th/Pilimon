<html>
<head>

<!-- Modal HTML -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<!-- Bulma CSS -->	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<!-- Fontawesome-->
<script src="https://kit.fontawesome.com/3b6fb5d974.js" crossorigin="anonymous"></script>
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
        width: 60px;
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
  @elseif(Auth::user()->role==3)
  <a class="navbar-item" href="{{route('manager.dashboard')}}">
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
      <a class="navbar-item" href="{{route('manager.dashboard')}}">
        <span class="icon-text">
            <span class="icon">
                <i class="fas fa-home"></i>
            </span>
            <strong>Home</strong>
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

      <div class="navbar-item has-dropdown is-hoverable" id = "Navdrop">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown is-hidden ">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
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

<div class="container">
<h1 class="title has-text-white is-text-left">History Logs</h1>
	
</div>
   
</section>
<div class = "container is-fluid has-text-white">
            <table class="table table is-striped  is-narrow" id = "example" style="width:100%" >
            <thead>
                    <tr>
                        <th class="has-text-centered" style=" width: 20px;">ID</th>
                        <th style=" width: 100px;">Name</th>	
                        <th style=" width: 70px;">Action</th>
                        <th>Content</th>
                        <th style=" width: 150px;">Performed on</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
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

  





<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
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
