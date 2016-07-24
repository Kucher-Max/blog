@if(isset($categories))
    @foreach($categories as $category)
        <div class="row" >
            <div class="col-md-3 col-md-offset-1">
                {{$category->name}}
            </div>
            <div class="col-md-3">
                <a id="deletetag" href="/admin/category/delete/{{$category->id}}">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </div>
        </div>  
        <br>
    @endforeach
@endif
@if(isset($name_category))
    @foreach($items as $item)
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <a href="/news/{{$item->id}}">
                    <h5>
                        {{$item->title}}
                    </h5>
                </a>
            </div>
        </div>
    @endforeach
@endif