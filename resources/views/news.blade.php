@extends('layouts.app')


@section('content')
    @if(isset($item))
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>{{$item->title}}</h3>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
           @if(count($img)>0)
            @foreach($img as $image)
               @if($image!="")
                <div class="col-md-5 col-md-offset-1">
                <img width=300 src="/picture/{{$image}}" class="img-thumbnail">
                </div>
                @endif
            @endforeach
            @endif
        </div>
        <br>
        <div class="row">
            <div style="font-size:16px" class="col-md-8 col-md-offset-1">
                {{$item->text}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-1 col-md-1">
                <span class="glyphicon glyphicon-eye-open">
                    {{$item->views}}
                </span>
            </div>
            <div class="col-md-3">
                <script>
                    function getrand(){
                        return Math.floor(Math.random() * (10 - 0 + 1)) + 0
                    }
                    function changetext(){
                        $(".online-user").text("Online view: "+getrand());
                    }
                    $(document).ready(function(){
                       setInterval(changetext,3000);
                    });
                </script>
                <span class="online-user">Online view:</span>
            </div>
            <div class="col-md-6">
            @if(isset($tags))
                @foreach($tags as $tag)
                   <a href="/tag/{{$tag->id}}">
                    <span style="font-size:13px;margin:5px" class="label label-success"> 
                        {{$tag->name}}
                    </span>
                    </a>
                @endforeach
            @endif
            </div>
        </div>

           <hr>
            <div class="row">
                <div class="col-md-8    col-md-offset-1">
                    <h2>Comment({{count($comments)}})</h2>
                </div>
            </div> 
            @if(Auth::check())  
            <div class="row">
                <div class="col-md-11    col-md-offset-1">
                    <form action="/news/{{$item->id}}/addcoment" method="post" class="form-horizontal">
                        {!!csrf_field()!!}
                       <div class="form-group">
                        <textarea name="comment" id="" cols="100" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Comment</button>
                        </div>
                    </form>
                </div>
            </div>  
            @endif
            <hr>
        @if(isset($comments))
        @if(count($comments)>0)
            @foreach($comments as $comment)
                <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-8">
        <h4>"{{$comment->user_name}}" write on {{$comment->created_at}}:</h4>
                        </div>
                        <div class="col-md-2">
                            <a href="/comment/{{$comment->id}}/like"><span style="font-size:20px;cursor:pointer" class="glyphicon glyphicon-hand-up">
                            {{$comment->like}}
                        </span></a>
                                                   <a href="/comment/{{$comment->id}}/unlike"><span style="font-size:20px;cursor:pointer" class="glyphicon glyphicon-hand-down">
                         {{$comment->unlike}}
                        </span>
                        </a>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            {{$comment->text}}
                        </div>
                        
                    </div>
                </div>
@if(Auth::check() && Auth::user()->isAdmin)
                <div class="col-md-1">
                            <div class="row">
                                <div class="col-md-12">
                                                               <a href="/admin/comment/{{$comment->id}}/change/">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                                                <a href="/admin/comment/{{$comment->id}}/delete/">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a> 
                                </div>
                            </div>
                        </div>
@endif
            </div>
                <hr>
            @endforeach
        @endif
        @endif
    @endif
@endsection