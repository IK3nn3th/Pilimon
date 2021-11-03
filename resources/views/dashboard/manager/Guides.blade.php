@extends('layouts.ManagerLayout')

@section('content')
<div class = "w-4/5 m-auto text-center">
    <div class = "py-15 border-b border-gray-200">
        <h1 class = "text-4xl text-white">
        Latest Guides
        </h1>
    </div>
</div>
@foreach($guides as $guide)
<div class = "sm:grid grid-cols-2 gap-1 w-5/5  py-15 border-b border-gray-200">
        <div class = "mx-auto">
            <img src= "/images/logo_plmun.png" width="200" alt="" class= "object-contain">

        </div>
        <div> 
            <h2 class= "text-5xl font-bold text-white pb-4">
              {{$guide->title}}
            </h2>
            
            <span class = "text-white">
                By <span class = "font-bold  text-black">{{ $guide->fname}} {{ $guide->lname}}</span>, <span class = "font-bold underline"> Last Updated: 
                {{ date ('jS M Y', strtotime($guide->updated_at)) }}</span>, <span> Views: {{$guide->views}} </span>
            </span> 
           
        
            <p  class= "pt-8 text-white italic text-xl ">
            Category: {{$guide->category}}
            </p>
          
            <p  class= "pt-8 text-gray-700 text-xl pb-10 leading-8 font-light">
            <span class = "font-bold">Description:  </span>{{$guide->description}}
            </p>

            <a href="/manager/guide/{{$guide->slug}}"
            class = "uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Keep reading
            </a>
        </div>    
</div>
@endforeach
@endsection
