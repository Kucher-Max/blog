@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if(isset($adv))
            @if(count($adv)>0)
                <div class="row">
                    <div class="col-sm-6">
                        Isset advertising({{count($adv)}}):
                    </div>
                </div>
@foreach($adv as $a)
<div class="row">
    <div class="col-md-5">
        {{$a->title}}
    </div>
    <div class="col-md-offset-1 col-md-3">
        <a href="/advertising/{{$a->id}}/delete">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-1 col-md-6">
    <a href="/picture/advertising/{{$a->picture}}" class="img-thumbnail"></a>
    </div>
</div>    
<hr>
               @endforeach
               @endif
               @endif
               @if(count($adv)!=4)
               <hr>
               <div class="row">
                   <div class="col-md-offset-3">
                       
               <h4>Add new advertise</h4>
                   </div>
               </div>
                <form enctype="multipart/form-data" class="form-horizontal" method="post" action="/advertising/add">
                <div  class="col-md-5 form-group">
                   <input type="text" name="title" class="form-control" value="">
                </div>
                    <div class="col=md-5 form-group">
                        {{csrf_field()}}
@if(count($pictures)>0)
                        <select name="pic_list" id="">
                            @foreach($pictures as $p )
                                <option value="{{$p}}">{{$p}}</option>
                            @endforeach
                        </select>
                        
@endif
                       <div class="col-md-5">
                        <input type="file" name="picture" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
               </form>
               @endif
    </div>
</div>

@endsection