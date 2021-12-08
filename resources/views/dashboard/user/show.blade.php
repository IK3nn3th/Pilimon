@extends('layouts.navbar')

@section('content')

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
                            <button name= "submit" class="button is-size-3-desktop is-size-6-mobile buttons is-centered">
                                Very helpful
                            </button>
                        </form>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Total Likes</p>
                        <p class="title">{{$guides->likes}}</p>
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
                
        
   
@endsection
