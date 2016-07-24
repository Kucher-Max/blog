@extends('layouts.app')
@section('content')
    <div class="col-md-offset-1">
        @if(isset($tags))
            <h2>Tag</h2>
        @else
            <h2>{{$name_tag}}</h2>
        @endif
    </div>
    <br>
    <hr>
    @include('common.message')
    <div class="categiry_list">
        @include('tag.index')
    </div>
    <hr>
    @if(isset($name_tag))
        <?php echo $items->render();?>
    @endif
    @if(isset($tags))
        @include('common.errors')
        <form action="/admin/tag/add" method="POST" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label for="name" class="col-md-1 control-label">Name</label>
            <div class="col-md-3">
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <dv class="col-md-1">
                <button   class="btn btn-default">
                    <span class="glyphicon glyphicon-plus"></span> Add tag
                </button>
            </dv>
        </div>
        </form>
    
    @endif
@endsection