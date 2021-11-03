@extends('layouts.app')

@section('content')


<div>

            <div class="w-4/5 m-auto text-left text-gray-800">
                <div class="py-15">
                    <h1 class="text-6xl">
                    {{$guides->title}}
               
                    </h1>
                </div>
            </div>
    <div class="w-4/5 m-auto ">
        <span class="text-black">
        Created by:  <span class="font-bold text-black text-2xl">
        {{ $guides->fname}} {{ $guides->lname}}</span>,  
        Last Updated:  <span class = "font-bold underline text-2xl"> 
                    {{ date ('jS M Y', strtotime($guides->updated_at)) }}</span>
        </span>
        <p  class= "pt-8 text-gray-500 italic text-xl ">
        <span class = "font-bold text-2xl"> Category:</span> {{$guides->category}}
        </p>
        <p  class= "pt-8 text-xl pb-10 leading-8 font-light text-black">
        <span class = "font-bold text-2xl">Description:  </span>{{$guides->description}}
        </p>
        
        <p  class= "pt-8 text-2xl pb-10 leading-8 font-light text-black">
        {!! nl2br(e($guides->content)) !!}
        </p>

    <!--helpful question -->
<div class="bg-gray-50">
  <div class="max-w-4xl mx-auto py-6 px-4 sm:px-3 lg:py-8 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Is this helpful?</span>
                <span class="block text-indigo-600">Let us know!</span>
            </h2>
        <div class="mt-3 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                           <form action="/guide/{{$guides->id}}/like" method = "POST">
                            @csrf 
                            <button name= "submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-3xl font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                             Very helpful
                            </button>
                            </form>
                </div>
               
        </div>
  </div>
</div>



    <!--Comment Section-->


        <div id="app">
            
                            <div>
                                <h2 class="mt-6 text-4xl leading-10 tracking-tight font-bold">
                                Comments</h2>
                                <br>
                            </div>
                   
                            <div>
                                <form action="/guide/{{$guides->id}}/comments" method = "POST" class="mb-0"> 
                                @csrf
                                <textarea name= "comment" class = "mt-1 py-2 px-3 block w-full border border-black text-black rounded-md shadow-sm" placeholder="Write your comment here" required></textarea>
                                <button name= "submit" class = "mt-6 py-2 px-4 rounded-lg text-2xl bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">  Post </button>
                            </form>
                            </div>
                    <div class = "mt-6">
                            @foreach ($comments as $comment)
                            </br>
                                <div class="mb-5 bg-white  px-4 py-6 rounded-sm shadow-md">
                                        <div class = "flex">
                                                <div class = "mr-3 flex flex-col justify-center">
                                                        <div>
                                                                <?php 
                                                                    $fname = $comment->fname;
                                                                    $lname = $comment->lname;
                                                                    $initials= strtoupper($fname[0].$lname[0]);
                                                                ?>
                                                                <span class = "bg-gray-300 p-3 rounded-full">{{$initials}}</span>
                                                        </div>
                                                    
                                                </div>
                                                <div class = "flex flex-col justify-center">
                                                    <p class ="font-bold text-2xl text-black" >{{ $comment->fname.' '.$comment->lname}}  </p>
                                                    <span class = "text-lg font-medium text-gray-500">{{$comment->created_at->diffForHumans()}}</span>                           
                                                </div>
                                        </div>
                                    <div class = "mt-5">
                                        <p class ="font-light text-2xl text-black" >{!! nl2br(e($comment->comment))!!}</p>
                                    </div>
                                   @if(Auth::user()->id === $comment->UserID)
                                    <div class="inline-flex rounded-md shadow">
                                            <form action="/comments/{{$comment->id}}" method = "POST">
                                                @csrf 
                                                <button name= "submit" class="mt-5 inline-flex items-center justify-center px-5 py-3 border border-transparent text-xl font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                                    DELETE COMMENT
                                                </button>
                                                </form>
                                    </div>
                                    @endif
                                </div>
                            @endforeach 
                            {{$comments->links('pagination::bootstrap-4')}}
                    </div>
        
        </div>
    </div>
</div>

                
        
   
@endsection
