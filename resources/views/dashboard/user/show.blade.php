@extends('layouts.navbar')

@section('content')
<section class="section">
    @if(Auth::user()->id == $guides->UserID)
<a class="button has-text-black modal-button edit"   id="edit" data-id="{{$guides->id}}" data-target = "#editGuideModal"><i class="fas fa-edit">&nbsp EDIT GUIDE</i></a>
<a href="#deleteGuideModal" class="button  modal-button delete1" data-id="{{$guides->id}}"  data-target = "#deleteGuideModal"><i class="fas fa-trash-alt"></i>&nbsp DELETE GUIDE</a>
	@endif		
</section>

<section class="section has-text-centered has-text-white">
             <h1 class="title  has-text-white">
             {{$guides->title}}
             </h1>
             
        <p class="subtitle is-size-6-mobile is-size-5-desktop  has-text-white">
        Created by:  
        {{ $guides->fname}} {{ $guides->lname}}
        </br>
        Last Updated:  

        {{ date ('jS M Y', strtotime($guides->updated_at)) }}
        </p>
        </br>
        <p  class= "box is-6 has-text-justified category">
        <span class = ""> <b>Category: </b></span> {{$guides->category}}
        </p>
        <p  class= "box is-6  has-text-justified category">
        <span class = ""><b>Description: </b></span> {{$guides->description}}
        </p>
</section>
<section class = "section">

<div class="box  text--content">     
        <p  class= "content has-text-justified">
        {!! nl2br(e($guides->content)) !!}
        </p>
</section>
    <!--helpful question -->
<section class="section">
  
        <div class="card bm--card-equal-height">
            <card class="card-content">
                <div class="level is-mobile">
                    <div class="level-item has-text-centered">
                        <div>
                        <p class="title  is-size-6-mobile is-size-3-desktop">Is this helpful?</p>
                        <p class="title  is-size-6-mobile is-size-3-desktop ">Let us know!</p>
                        </div>
                    </div>
                <div class="level-item has-text-centered">
                    <div>
                        <form action="/user/guide/{{$guides->id}}/like" method = "POST">
                            @csrf 
                            @if ($likeCheck == 1)
                            <button name= "submit" class="button is-ghost is-size-3-desktop is-size-5-mobile">
                            <i class="fa fa-thumbs-up"></i> Liked
                            </button>
                            @else
                            <button name= "submit" class="button is-ghost is-size-3-desktop is-size-5-mobile">
                            <i class="fa fa-thumbs-o-up"></i> Like
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Total Likes</p>
                
                        <p class="title">{{$likes}}</p>
                    </div>
                </div>  
            </card>
        </div>
  
</section>




    <!--Comment Section-->
   
<script>
var text_max = 200;
$(document).ready(function() {

$('#count_message').html('0 / ' + text_max );


$('#comment').keyup(function() {
  var text_length = $('#comment').val().length;
  var text_remaining = text_max - text_length;
  
  $('#count_message').html(text_length + ' / ' + text_max);
});

});
</script>

        <div class="container">
            
                            <div class = "column">
                                <h2 class="title  has-text-white">
                                Comments:</h2>
                          
                            </div>
                   
                            <div class = "column  has-text-right">
                                <form action="/user/guide/{{$guides->id}}/comments" method = "POST" class="mb-0"> 
                                @csrf
                                <textarea name= "comment" id="comment" style = " resize: none;" class = "textarea is-success" placeholder="Write your comment here" maxlength="200" rows="5" required></textarea>
                                @if(!empty( $errors->add->has('comment')  ))
                                <em class="has-text-danger "> {{ $errors->add->first('comment') }}</em>
                                @endif
                                <span class = "has-text-white" id="count_message">  </span>
                                <button name= "submit" class = "mt-4 button is-success is-fullwidth is-rounded is-normal buttons is-centered "> Post </button>
                            </form>
                            </div>
                    <div class = "column">
                            @foreach ($comments as $comment)
                            </br>

                            <div class="box">
                                <article class="media">
                                            <div class="media-left">
                                            <figure class="image is-64x64 is-rounded has-background-grey has-text-centered">
                                                                <?php 
                                                                    $fname = $comment->fname;
                                                                    $lname = $comment->lname;
                                                                    $initials= strtoupper($fname[0].$lname[0]);
                                                                ?>
                                                <p class="title pt-3">{{$initials}}</p>
                                            </figure>
                                            </div>
                                    <div class="media-content">
                                            <div class="content">
                                                        <p>
                                                        <strong>{{ $comment->fname.' '.$comment->lname}}</strong> <small>{{$comment->created_at->diffForHumans()}}</small>
                                                        <br>
                                                        {!! nl2br(e($comment->comment))!!}
                                                        </p>
                                            </div>
                                    </div>
                                </article>
                                @if(Auth::user()->id === $comment->UserID || Auth::user()->role <=2)
                                    <div class="buttons is-centered">
                                            <form action="/user/comments/{{$comment->id}}" method = "POST">
                                                @csrf 
                                                <button name= "submit" class="button is-small has-background-danger">
                                                   <p> DELETE COMMENT</p>
                                                </button>
                                                </form>
                                    </div>
                                @endif
                            </div>
                                
                            @endforeach 
                            {{$comments->links()}}
                    </div>
        
        </div>
    </div>
</div>
</section>
 

 <!-- Edit Modal HTML -->
 <div id = "editGuideModal" class = "modal editguide">
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
							
								<input disabled class="input is-success" name="title" id="etitle" value="{{ old('title') }}" type="text" placeholder="Input Title" required>
								
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
                                    <br>
                                <h5 class="title is-5">Potential questions that this guide can answer:</h5>
                                <h5 class="subtitle is-7">This will make us provide the right guide fors our users through our search results. 
                                    <br>Please separate each questions with a comma <b>( , )</b> sign.  </h5>
								<textarea class="textarea is-success" name="index" id="eindex" value= "{{ old('index') }}"  type="text" placeholder="Input here" required></textarea>
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
	</div>


    <script>
$(document).on('click','.edit',function(){
	
	var guide_id = $(this).data('id');

	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
	$("#eid").val(data.details.id);
	
	$("#etitle").val(data.details.title);
	$("#ecategory").val(data.details.category);
	$("#edesc").val(data.details.description);
	$("#econtent").val(data.details.content);
    $("#eindex").val(data.details.index);
	},'json');


 
})


$(document).on('click','.delete1',function(){
	var guide_id = $(this).data('id');
	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
	$("#deleteID").val(data.details.id);
	
	},'json');

 
})

</script>  
        
   
@endsection
