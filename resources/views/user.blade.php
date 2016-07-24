@extends('layouts.app')


@section('content')
   <div class="row">
       <div class="col-md-8 col-md-offset-3">
           <h3>{{$name}}</h3>
       </div>
   </div>
    @if(isset($comments))
    @foreach($comments as $comment)
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <a href="/news/{{$comment->item_id}}"><h4><stong>Go to the page</stong></h4></a>
                <br>
                <br>
                {{$comment->text}}
            </div>
            <div class="col-md-3">
                                        <a href="/comment/{{$comment->id}}/like"><span style="font-size:20px;cursor:pointer" class="glyphicon glyphicon-hand-up">
                        </span></a>
                            {{$comment->like}}
                        <br>
                        <br>
                        <a href="/comment/{{$comment->id}}/unlike"><span style="font-size:20px;cursor:pointer" class="glyphicon glyphicon-hand-down">
                        </span>
                        </a>
                            {{$comment->unlike}}
            </div>
        </div>
        <hr>
    @endforeach
    
        <?php echo $comments->render();?>
    @endif
@endsection