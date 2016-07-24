<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Comment;
use App\User;

use DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function getCatItem()
    {
        $categorys=Category::all();
        $arr=array();
        foreach($categorys as $category)
            {   
                $items=Item::where('category',$category->name)
                    ->orderBy('created_at','desc')
                    ->take(5)
                    ->get();
                foreach($items as $item){
                    $arr[]=[
                        'category'=>$category->name,
                        'news'=>[
                            'title'=>$item->title,
                            'text'=>$item->text,
                            'id'=>$item->id
                        ]
                    ];
//                    $arr[]['namecategory']['news']['id']=$item->id;
//                    $arr[]['namecategory']['news']['text']=$item->text;
                }
            }
        $users=DB::select('select count(*) as cnt,user_name from comments GROUP BY user_name ORDER BY cnt   DESC limit 5 ');
        $categories=Category::all()
            ->groupBy('name');
    $comments=DB::select('select count(*) as cnt,item_id from comments where date(created_at)=date(now()-interval 1 day) group by item_id order by cnt desc limit 3 ');
    foreach($comments as $c){
        if(Item::find($c->item_id)!=null){
            $most[]=[
                'title'=>Item::find($c->item_id)->title,
                'id'=>$c->item_id,
                'cnt'=>$c->cnt
            ];
        }
    };
    $rand=DB::select("select * from items where picture!='' order by rand() limit 3");
        foreach($rand as $key=>$r){
            if(strpos($r->picture,";"))
            {
                $pic=substr($r->picture,0,strpos($r->picture,";"));
            }
            else
            {
                $pic=$r->picture;
            }
            $rand[$key]->picture=$pic;
        }
        
        return view('task',[
            'arr'=>$arr,
            'rand'=>$rand,
            'categories'=>$categories,
            'mans'=>$users,
            'items'=>$most
        ]);
      
  }
}			