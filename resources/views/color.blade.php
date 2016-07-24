@extends('layouts.app')


@section('content')
<form action="/color/manager/save"  method="POST" >
{{csrf_field()}}

   <div class=" col-md-offset-1 form-group">
   background color <br>
    <input type="text" value="{{$color->background_color}}" name="back">
        <br>
        <br>
        header color
        <br>
    <input type="text" value="{{$color->head_color}}" name="head">
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-1">
            <button type="submit" class="btn btn-success">
                save change
            </button>
        </div>
    </div>

</form>
@endsection