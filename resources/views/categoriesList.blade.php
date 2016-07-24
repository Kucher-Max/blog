@extends('layouts.app')
@section('content')
    <div class="col-md-offset-1">
       @if(isset($categories))
        <h2>Category</h2>
        @elseif(isset($name_category))
        <h2>{{$name_category}}</h2>
        @endif
    </div>
    <br><hr>
    @include('common.message')
    <div class="categiry_list">
        @include('category.index')
    </div>
    
    <hr>
    @if(isset($name_category))
        <?php echo $items->render();?>
    @endif
    @include('common.errors')
    @if(isset($categories))
    <form action="/admin/category/add" method="POST" class="form-horizontal">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <div class="form-group">
        <label for="name" class="col-md-1 control-label">Name</label>
        <div class="col-md-3">
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <dv class="col-md-1">
            <button   class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span> Add category
            </button>
        </dv>
    </div>
    </form>
    @endif
@endsection