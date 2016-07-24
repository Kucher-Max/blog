@extends('layouts.app')
@section('content')
<form action="/search/query" method="post">
{{csrf_field()}}
<div class="row">
    <div class="col-md-offset-1 col-md-2">
        <div class="row">
            <div class="col-md-12">
                Tags <br>
                <span id="taglist"></span>
                <input type="text" id="tags" name="tags" hidden ></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <select id="selectTags">
                        @if(isset($tags))
                            @foreach($tags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        @endif
                    </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                                    <span  id="addtag" class="btn btn-default">
                         Add tag
                    </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <input type="text" name="title" placeholder="title"></inpur>
    </div>
    <div class="col-md-2">
                            <select id="category" name="category">
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                        <option value="Nothing">Nothing</option>
                    </select>
    </div>
    <div class="col-md-2">
    For <br>
    <input type="date" name="ford"><br><br> To <br>
    <input type="date" name="tod">
    </div>
    <div class="col-md-2">
        <button class="btn btn-success" type="search">Search</button>
    </div>
</div>
</form>
@if(isset($items))
    <h3>Result: </h3>
    <br><br>
    @foreach($items as $item)
    
    <div class="row ">
        <div class="col-sm-5 col-md-offset-1">
            <h4><a href="/news/{{$item->id}}">{{$item->title}}</a></h4>
        </div>
    </div>
    <br>
    <div class="row ">
        <div class="col-md-offset-1 col-sm-5 ">
            <strong>Category:{{$item->category}}</strong>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            {{$item->text}}
        </div>
    </div>
    <hr>
    @endforeach
@endif
@endsection