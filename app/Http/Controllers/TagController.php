<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;
use DB;
use App\Tag;
use App\Item;
use App\Tagitem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function get()
    {
        //if(Auth::check()){
            $tags=Tag::all();
            return view('tagsList',['tags'=>$tags]);
        //}
    }
    public function delete($id)
    {
        if(!Auth::check())return;
        Tag::destroy($id);
        $tags=Tag::all();
        return redirect('/admin/tag/manager');
        //return view('categoriesList',['categories'=>$categories,'message'=>'Category was removed successfully']);
    }
    public function add(Request $request)
    {
        if(!Auth::check())return;
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if($validator->fails()){
            return redirect('/admin/tag/manager')
                ->withInput()
                ->withErrors($validator);
        } 
        $tag=new Tag;
        $tag->name=$request->name;
        $tag->save();
        
        $tags=Tag::all();
        return redirect('/admin/tag/manager');
        //$message['text']="Category was created successfully";
        //return view('categoriesList',['message'=>'Category was created successfully','categories'=>$categories]);
    }
    public function tag($id)
    {
//        $items=DB::select('SELECT * FROM items WHERE id in(select itemId from tagitems where tagId=?)',array($id))->paginate(5);
        $items=Tag::find($id)->roles()->paginate(5);
        $tag=Tag::find($id);
        return view('tagsList',['name_tag'=>$tag->name,'items'=>$items]);    
    }
}