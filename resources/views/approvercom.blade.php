@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <h3>Approvers comments ({{count($comment)}})</h3>
        </div>
    </div>
        <br>
        <br>
        <br>
    @if(isset($comment))
<form action="/coment/allow"  method="POST" >
{!!csrf_field()!!}
<!--
       <input type="checkbox" name="allow[]" id="" value="1">
       <input type="checkbox" name="allow[]" id="" value="2">
       <input type="checkbox" name="allow[]" id="" value="3">
       <input type="checkbox" name="allow[]" id="" value="4">
       <input type="checkbox" name="allow[]" id="" value="5">
       <input type="checkbox" name="allow[]" id="" value="6">
       <input type="checkbox" name="allow[]" id="" value="7">
       <input type="checkbox" name="allow[]" id="" value="8">
       <input type="checkbox" name="allow[]" id="" value="9">
       <input type="checkbox" name="allow[]" id="" value="10">
-->

        @foreach($comment as $c)
            <div class="row">
               <div class="col-md-offset-1 col-md-1">
                   
               <input type="checkbox" name="allow[]" value="{{$c->id}}">
               </div>
                <div class="col-md-8 ">
                    {{$c->text}}
                </div>                
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-2">
                <a href="/news/{{$c->item_id}}">View page</a>
                </div>
                <div class="col-md-2 ">
                <a href="/users/{{$c->user_name}}">View author</a>
                </div>
            </div>
            <hr>
                    

        @endforeach
                <div class="row">
            <div class="col-md-offset-3 col-md-1">
                
                <button type="submit" class="btn btn-success">Allow view</button>
            </div>
        </div>
</form>
    @endif
@endsection