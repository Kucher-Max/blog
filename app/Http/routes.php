<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Item;
use App\Category;
use App\Tagitem;
use App\Tag;
use App\User;
use App\Comment;
use App\Color;
use App\Advertise;
use Illuminate\Http\Request;
Route::any('/',                     'IndexController@getCatItem');
Route::any('/addform/add',               'ItemController@addformadd');
Route::any('/addform/',                  'ItemController@addform');
Route::post('/get',function(Request $request){
    $tags=Tag::where('name','like','%'.$request->data.'%')->get();
    return ($tags);
    //echo $request->data;
});
Route::get('advertising/{id}/delete',function($id){
     Advertise::destroy($id);
    return redirect()->back();

});
Route::post('/color/manager/save',function(Request $request){
    $color=Color::find(1);
    $color->background_color=$request->back;
    $color->head_color=$request->head;
    $color->save();
    $dir=public_path().'/css/';
    $headdir=$dir.'/head.css';
    $bodydir=$dir.'/body.css';
    $headcolor=$request->head;
    $headtext=".page-header {height:120px;background-color:".$headcolor.";}";
    $bodycolor=$request->back;
    $bodytext="body{overflow-x: hidden;background-color:".$bodycolor.";}";
    
    File::put($headdir,$headtext);
    File::put($bodydir,$bodytext);
    return redirect()->back();
});

Route::any('/admin/comment/{id}/delete/',function($id){
    $comment=Comment::destroy($id);
    return redirect()->back();
});
Route::get('/advertising/',function()
{
    $pictures=File::files(public_path().'/picture/advertising/');
    foreach($pictures as $k=> $p)
    {
        $name=pathinfo($p);
        $pictures[$k]=$name["basename"];
    }
    $adv=Advertise::all();
    return view('adv',['adv'=>$adv,'pictures'=>$pictures]);
});
Route::post('/advertising/add',function(Request $request){
dd($request->file('picture'));
    $file=$request->file('picture');
    $f_name=time().$file->getClientOriginalName();
    $file->move(public_path().'/pictures/advertising/',$f_name);
    $adv=new Advertise;
    $adv->title=$request->title;
    $adv->picture=$f_name;
    $adv->save();
return redirect()->back(); 
});
Route::any('/approver','CommentController@getapprover');
Route::post('/coment/save',function(Request $request){
    //echo $request->text;
    $comment=Comment::find($request->id);
    $comment->text=$request->text;
    $comment->save();
    return redirect()->to('/news/'.$comment->item_id);
});
Route::get('/color/manager','ColorController@color');
Route::any('/admin/category/manager',    'CategoryController@get');
Route::any('/admin/category/delete/{id}','CategoryController@delete');
Route::any('/admin/category/add/',       'CategoryController@add');
Route::any('/admin/comment/{id}/change/',function($id){
    $comment=Comment::find($id);
    return view('editcomment',[
        'comment'=>$comment
    ]);
});
Route::get('/search',function(){
    $categories=Category::all();
        $tags=Tag::all();
        return view('search',['categories'=>$categories,'tags'=>$tags]);
});
Route::any('/category/{name_category}',  'CategoryController@category');
Route::any('/comment/{id}/like',function($id){
    $comment=Comment::find($id);
    $comment->like++;
    $comment->save();
        return redirect()->back();
});
Route::any('/comment/{id}/unlike',function($id){
    $comment=Comment::find($id);
    $comment->unlike++;
    $comment->save();
    
        return redirect()->back();
});
//Route::post('/comment/allow','CommentController@allowcomment');
Route::post('/coment/allow',function (Request $request){
    foreach($request->allow as $comment_id)
    {
        $comment=Comment::find($comment_id);
        $comment->approver=0;
        $comment->save();
    }
    return redirect()->back();
});
Route::post('/news/{id}/addcoment','UserController@addcomment');
Route::any('/admin/tag/manager',         'TagController@get');
Route::any('/admin/tag/delete/{id}',     'TagController@delete');
Route::any('/admin/tag/add/',            'TagController@add');
Route::any('/tag/{id}/',                 'TagController@tag');
Route::any('/news/{id}',                 'ItemController@item');
Route::post('/get',function(Request $request){
    $tags=Tag::where('name','like','%'.$request->data.'%')->get();
    return ($tags);
    //echo $request->data;
});
Route::get('/auth/login','Auth\AuthController@getLogin');
Route::get('/auth/logout',function(){
    Auth::logout();
    return redirect()->back();
});
Route::post('/auth/login','Auth\AuthController@postLogin');
Route::get('/auth/register','Auth\AuthController@getRegister');
Route::post('/auth/register','Auth\AuthController@postRegister');
Route::get('/admin',function(){
    return redirect()->back();
});
Route::get('/news/{id}/delete',function($id){
    $item=Item::find($id);
    $item->delete();
    return redirect()->back();
});

Route::get('/users/{name}','UserController@user');
Route::post('/search/query',function(Request $request){
    $tags=explode(';',$request->tags);
    $tags=implode(",",$tags);
    $tags=mb_substr($tags,1);
    //dd($tags);
    $query="";
    if($tags!=" ")
        //$query=' and tags in('.$tags.')';
    if($request->ford=" "||$request->tod==" ")
    {        
        if($request->category=="Nothing")
        {
            $items=DB::select('Select * from items where title like "%'.$request->title.'%"'.$query);
        }else{
            $items=DB::select('Select * from items where title like "%'.$request->title.'%" and category="'.$request->category.'"'.$query);
        }
    }else
        $items=DB::select('Select * from items where title like "%'.$request->title.'%" and (created_at>=('.$request->ford.') and created_at<('.$request->tod.')) and category='.$request->category.'"'.$query);
            
    return view('search',['items'=>$items]);
    //dd($item);
});
           Route::post('/get',function(Request $request){
    $tags=Tag::where('name','like','%'.$request->data.'%')->get();
    return ($tags);
    //echo $request->data;
});								