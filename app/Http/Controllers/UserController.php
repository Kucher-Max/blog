<?php

namespace App\Http\Controllers;
use App\Faker\Factory as Faker;
use App\Category;
use Validator;
use App\Tag;
use App\TagItem;
use App\Item;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addcomment($id,Request $request){
        $comment=new Comment;
        $comment->approver=0;
        $item=Item::find($id);
        if($item->category=="Politics"){
            $comment->approver=1;
        }
        $comment->user_name=Auth::user()->name;
        $comment->item_id=$id;
        $comment->text=$request->comment;
        $comment->like=0;
        $comment->unlike=0;
        $comment->save();
        return redirect()->to('/news/'.$id);
    } 
    public function user($name)
    {
        $comments=Comment::where('user_name',$name)
            ->orderBy('like','desc')
            ->paginate(5);
        return view('user',['comments'=>$comments,'name'=>$name]);
    }
}