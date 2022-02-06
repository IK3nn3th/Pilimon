@extends('layouts.navbar')

@section('content')
   
    <div class="section">

    </div>
        <div class = "title">
		<center>
				<h1 class = "title is-size-1-desktop ">
            Your guides 
            </h1>
		</center>
	    </div>
		<div class = "section ">
			<div class="columns is-multiline">
            @forelse($guides as $guide)
				<div class= "column is-6-desktop is-12-mobile">
					<div class="card bm--card-equal-height">
						<div class="card-content" style="height: 100%">
						  <div class="media">
							<div class="media-left">
							  <figure class="image is-48x48">
								<img src="/images/logo_plmun.png" alt="Placeholder image">
							  </figure>
							</div>
							<div class="media-content">
							  <p class="title is-size-4-desktop is-size-6-mobile"> {{$guide->title}}</p>
							  
							</div>
						  </div>          
						</div>
                        <div class="card-content">
                                <p  class= "pt-8 text-white italic text-lg ">
                                    Category: {{$guide->category}}
                                    </p>
                                    <p  class= "pt-8 text-gray-700 text-lg   pb-10 leading-8 font-light">
                                    <span class = "font-bold">Description:  </span>{{$guide->description}}
                                    </p>    
                        </div>  
                        
                            <div class="card-content">
                                <a href="/user/guide/{{$guide->slug}}" class="button is-rounded buttons is-centered ">Keep Reading</a>
                            </div>
               
                        
                  
                        <footer class="card-footer">
                                <time class="card-footer-item" datetime="2016-1-1"><p class = "subtitle  is-size-6-mobile">Last updated: <br> {{ date ('jS M Y', strtotime($guide->updated_at)) }}</p></time>
                                <h6 class="card-footer-item "><p class = "subtitle  is-size-6-mobile"> Views: {{$guide->views}}</p> </h6>
                        </footer>
					</div>
				</div>
                @empty
              <div class="container has-text-centered">
					<h1 class = "subtitle is-size-3-desktop  has-text-white ">
							No guides created yet. Let's create one and share your knowledge! 
							</br></br></br>
					</h1>

					
              </div>
                @endforelse

				<a class=" mt-4 button modal-button  is-large is-info is-rounded is-fullwidth buttons is-centered" href="#addGuideModal" data-target = "#addGuideModal" >
						Create a new guide
						</a>
            </div>
        </div>

        <div class="section">
		{{$guides->links('vendor.pagination.bulma-simple')}}	
        </div>
		
		<div class="section">
			<div class = "title">
			<center>
					<h1 class = "title is-size-1-desktop ">
					 Most searched queries without results:
					</h1>
			</center>
			</div>
			@if (count($searches) > 0)
			<table class="table is-striped is-narrow is-hoverable is-fullwidth">
		
			<thead>
				<tr>
				<th  class="title is-size-6-mobile is-size-3-desktop has-text-centered ">Queries:</th>				
				<th  class="title is-size-6-mobile is-size-3-desktop has-text-centered ">Total number of times searched:</th>
				</tr>
			</thead>
			

			<tbody>
			@foreach ($searches as $search)
			<tr>
				<td><p class="title is-size-6-mobile is-size-3-desktop has-text-centered ">{{$search->search_term}}</p></td>				
				<td><p class="title is-size-6-mobile is-size-3-desktop has-text-centered ">{{$search->Search_count}}</p></td>
			</tr>

			 
              
			
			@endforeach
			</tbody>
			</table>
			@else
			<div class="container has-text-centered">
              <h1 class = "subtitle is-size-3-desktop has-text-white ">
                   All questions searched has results found!
              </h1>
              </div>	
			@endif
		</div>
		 
		<div class="section">
			<div class = "title">
			<center>
					<h1 class = "title is-size-1-desktop ">
					 Trending Searches:
					</h1>
			</center>
			</div>
			
			@if (count($searchterms) > 0)
			<table class="table is-striped is-narrow is-hoverable is-fullwidth">
			 
			<thead>
				<tr>
				<th  class="title is-size-6-mobile is-size-3-desktop has-text-centered ">Queries:</th>				
				<th  class="title is-size-6-mobile is-size-3-desktop has-text-centered ">Total number of times searched:</th>
				</tr>
			</thead>


			<tbody>
			@foreach ($searchterms as $searchterm)
			<tr>
				<td><p class="title is-size-6-mobile is-size-3-desktop has-text-centered ">{{$searchterm->searchterm}}</p></td>				
				<td><p class="title is-size-6-mobile is-size-3-desktop has-text-centered ">{{$searchterm->Searchcount}}</p></td>
			</tr>

		
			
			@endforeach

			</tbody>
			</table>
			@else
		 
              <div class="container has-text-centered">
              <h1 class = "subtitle is-size-3-desktop has-text-white ">
                   No questions searched so far!
              </h1>
              </div>

			@endif
						
		</div>

		

		
 


<!--Add  Modal HTML -->
    <div id = "addGuideModal" class = "modal addguide">
			<div class = "modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Add Guide Form </p>	
						
					</header>
						<section class="modal-card-body">
							<form action="{{route('guides.add')}}" method="POST">
								@csrf
								<h5 class="title is-5">Title</h5>
							
								<input class="input is-success" name="title" id="title" value="{{ old('title') }}" type="text" placeholder="Input Title" required>
									@if(!empty( $errors->add->has('title')  ))
									<script>
										$(document).ready(function() {
											$("html").addClass("is-clipped");
											$(".addguide").addClass("is-active");
										});
									</script>
									<em class="has-text-danger"> {{ $errors->add->first('title') }}</em>
									
									@endif
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
									<textarea class="textarea is-success" name="content" id="content" value= "{{ old('content') }}"  type="text" placeholder="Input Content" required></textarea>
									@error('content')
								
										<em class="text-danger"> {{ $message }}</em>
										
									@enderror
                                    <br>
                                <h5 class="title is-5">Potential questions that this guide can answer:</h5>
                                <h5 class="subtitle is-7">This will make us provide the right guide fors our users through our search results. 
                                    <br>Please separate each questions with a comma <b>( , ) sign.  </h5>
								<textarea class="textarea is-success" name="index" id="index" value= "{{ old('index') }}"  type="text" placeholder="Input here" required></textarea>
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
			


<script type="text/javascript">

$(".modal-button").click(function() {
          
	var target = $(this).data("target");
            $("html").addClass("is-clipped");
            $(target).addClass("is-active");
        
         });
         
		 $(".modalclose").click(function() {
         
            $(".modal").removeClass("is-active");
			$("html").removeClass("is-clipped");
         });
</script>

@endsection
