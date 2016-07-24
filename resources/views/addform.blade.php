@extends('layouts.app')

@section('content')
    <div class="panel-body">
       <div class="row">
            <div class="col-md-7 col-md-offset-3">
                <h2>Add new item</h2>
            </div>       
        </div>    
        <hr>   
        @include('common.errors');
        @include('common.message')
        <form enctype="multipart/form-data" action="/addform/add" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label for="task" class="col-md-3 control-label">Title</label>
                <div class="col-md-6">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="col-md-3 control-label">Category</label>
                <div class="col-md-6">
                    <select id="category" name="category">
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tag" class="col-md-3 control-label">Tag</label>
                <div class="col-md-6">
                    <span id="taglist"></span>
                    <input type="text" id="tags" name="tags" hidden ></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2 col-md-offset-3">
                    <select id="selectTags">
                        @if(isset($tags))
                            @foreach($tags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <span  id="addtag" class="btn btn-default">
                         Add tag
                    </span>
                </div>
            </div>            
            <div class="form-group">
                <label for="task" class="col-md-3 control-label">Text</label>
                <div class="col-md-6">
                    <textarea name="text" id="submit" cols="30" rows="10"class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="preview" class="col-md-3 control-label">
                    Picture
                </label>
                <div class="col-md-5">
                    <input name="preview[]" type="file" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary add_picture">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <button id="btnadditem"  class="btn btn-default">
                        <i class="fa fa-plus"></i> Add item
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection