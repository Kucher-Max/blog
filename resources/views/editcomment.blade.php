@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-md-11    col-md-offset-1">
<form action="/coment/save"  method="POST" >
{{csrf_field()}}

    <textarea name="text" id="" cols="30" rows="10">
        {{$comment->text}}
    </textarea>
    <input type="hidden" value="{{$comment->id}}" name="id">
    <div class="row">
        <div class="col-md-offset-3 col-md-1">
            <button type="submit" class="btn btn-success">
                save change
            </button>
        </div>
    </div>

</form>

</div> 
</div>
@endsection