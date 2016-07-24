<?php

namespace App\Http\Controllers;
use App\Faker\Factory as Faker;
use App\Category;
use Validator;
use App\Tag;
use App\Tagitem;
use App\Item;
use App\Comment;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function addform()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('addform',['categories'=>$categories,'tags'=>$tags]);

    }
    public function addformadd(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required|max:255',
            'text'=>'required'
        ]);
        if($validator->fails()){
            return redirect('/addform')
                ->withInput()
                ->withErrors($validator);
        }
        $root=public_path().'/picture/';
     $url_img=[];
        foreach($request->file('preview') as $file)
        {
            if(empty($file)) continue;

            $f_name=time().$file->getClientOriginalName();
$url_img[]=$f_name;            
$file->move($root,$f_name);
        }
        $preview=implode(';',$url_img);        
        $item=new Item;
        $item->title=($request->title);
        $item->text=($request->text);
        $item->category=$request->category;
        $item->picture=$preview;
        $item->save();
        $tags=explode(";",$request->tags);
        //return view('test',['tags'=>$tags]);
        foreach($tags as $tag){
            if($tag!=""){
                $tagi=new TagItem;
                $tagSearch=Tag::where('name',$tag)->firstOrFail();
                $tagi->tagId=$tagSearch->id;
                $tagi->itemId=$item->id;
                $tagi->save();
            }
        }      
        $categories=Category::all();
        $tags=Tag::all();
        //$message['text']="The new was created successfully";
        //return view('addform',['categories'=>$categories,'tags'=>$tags,'message'=>'The new was created successfully']);
        return redirect('/addform');
            
    }
    public function item($id)
    {        
        $item=Item::where('id',$id)->first();
        $item->views++;
        $item->save();
        $img=explode(';',$item->picture);
        if(Item::where('id','=',$id)->first()->category=='Politics'){
            $comments=DB::select('select * from comments where item_id='.$id.' and approver =0   ');
        }else{
        $comments=Comment::where('item_id',$id)
            ->orderBy('like','disc')
            ->get();
        }
        $itemn=Tagitem::where('ItemId',$id)->get();
        if($itemn!='[]')
        {
            foreach($itemn as $it)
            {
                $newtag[]=Tag::where('id',$it->tagId)->first();
            }
            //if(isset($newtag))
                return view('news',['comments'=>$comments,
                                    'item'=>$item,
                                    'img'=>$img,
                                    'tags'=>$newtag]);
        }
        return view('news',['comments'=>$comments,
                                    'item'=>$item,
                                    'img'=>$img]);
    }
}	