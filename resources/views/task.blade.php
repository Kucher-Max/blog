@extends('layouts.app')

@section('content')

       <div class="row">
       
        <div  class="col-md-4">
           <div class="row">
               <div class="col-md-12">
                   <h2>Category</h2>
               </div>
           </div>
        @foreach($categories as  $category )
            <div class="row">
                <div class="col-md-3 ">
                    <h3>
                        <a href="/category/{{$category['0']->name}}">
                            {{$category['0']->name}}: 
                        </a>
                    </h3>
                </div>
            </div>
            @foreach($arr as $iteme)
                @if($iteme['category']==$category['0']->name)
                    <div class="row">
                        <div class="col-md-9 col-md-offset-1">
                            <a href="/news/{{$iteme['news']['id']}}">
                                <h5>
                                    {{$iteme['news']['title']}}
                                </h5>
                            </a>
                        </div>
                        @if(Auth::check())
                       @if(Auth::user()->isAdmin)
                       <div class="col-md-1">
            <a href="/news/{{$iteme['news']['id']}}/delete">
                           <span class="glyphicon glyphicon-remove"></span>
                   </a>
                       </div>
                       @endif
                       @endif
                       
                    </div>
                @endif
            @endforeach
            
        @endforeach
        </div>
        
        
        
        
<!--///////////////////////////////////////////////////////////////-->
       
       
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <h2>Top 5 commentators</h2>               
                </div>
            </div>
            @foreach($mans as $man)
                <div class="row">
                    <div class="col-md-6">
                       <a href="/users/{{$man->user_name}}">
                        {{$man->user_name}}
                        </a>
                    </div>
                    <div class="col-md-6">
                        {{$man->cnt}}
                    </div>
                </div>
            @endforeach
            <hr>
@if(count($items)>0)
               <div class="row">
                <div class="col-md-12">
                    <h3>Yesterday's popular news</h3>               
                </div>
            </div>
            <br>
            
            @foreach($items as $item)
                    <div class="row">
                        <div style="font-size:20px" class="col-md-12">
                           <a href="/news/{{$item['id']}}">
                            {{$item['title']}}
                            </a>
                        </div>
                    </div>
                    <div>
                        Count comment:{{$item['cnt']}}
                    </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-md-12">
                    <h3>No yesterday popular news</h3>               
                </div>
            </div>
            @endif
        </div>
       
       
       
        
        
<!--///////////////////////////////////////////////////////////////-->
       
       
       
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
                        <ol class="carousel-indicators">
 <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
 <li data-target="#myCarousel" data-slide-to="1"></li>
 <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
  @foreach($rand as $r)
                           @if($rand[0]==$r)
                    <div class="active  item">
                       @else
                       <div class="item">
                       @endif
                        <img src="/picture/{{$r->picture}}" alt="">
                        <div class="carousel-caption">
                            <a href="/news/{{$r->id}}">
                                <h3 style="color:white">{{$r->title}}</h3>
                            </a>
                        </div>
                    </div>
                            @endforeach
                        </div>
                        <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
                        <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
                    </div>
                </div>
            </div>
        </div>
       
       </div>
@endsection