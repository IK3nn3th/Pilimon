@extends('layouts.navbar')

@section('content')

    <div class = "section">
        <div class="columns is-mobile is-multiline ">
            <div class= "column is-12-desktop">
                <form action="{{ route('web.search') }}" method="GET">
			 	@csrf
				<input class="input" type="text" name="query"  value="{{ request()->input('query') }}" placeholder="Search here...">
			 
				<button type ="submit" class=" mt-4 button is-success is-rounded is-fullwidth buttons is-centered" >
				  Search
				</button>
                <span class="text-danger">@error('query'){{ $message }} @enderror</span>
                </form>
            </div>
        </div>
    </div>

        <div class = "title">
		<center>
				<h1 class = "title is-size-1-desktop ">
				LATEST GUIDES
				</h1>
		</center>
	    </div>
		<div class = "section ">
			<div class="columns is-multiline">
            @foreach($guides as $guide)
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
							  <p class="subtitle is-size-6-mobile"><b>Author: {{ $guide->fname}} {{ $guide->lname}}</b></p>
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
                                <a href="/guide/{{$guide->slug}}" class="button is-rounded buttons is-centered ">Keep Reading</a>
                            </div>
               
                        
                  
                        <footer class="card-footer">
                                <time class="card-footer-item" datetime="2016-1-1"><p class = "subtitle  is-size-6-mobile">Last updated: <br> {{ date ('jS M Y', strtotime($guide->updated_at)) }}</p></time>
                                <h6 class="card-footer-item "><p class = "subtitle  is-size-6-mobile"> Views: {{$guide->views}}</p> </h6>
                        </footer>
					</div>
				</div>
                @endforeach		
            </div>
        </div>
			
<div> 
{{$guides->links()}}
</div>
@endsection
