<?php

namespace App\Http\Controllers;


use App\Category;
use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class CategoryController extends Controller
{
    public function get()
    {
        //if(Auth::check()){
            $categories=Category::all();
            return view('categoriesList',['categories'=>$categories]);
        //}
    }
    public function delete($id)
    {
        Category::destroy($id);
        $categories=Category::all();
        return redirect('/admin/category/manager');
        //return view('categoriesList',['categories'=>$categories,'message'=>'Category was removed successfully']);
    }
    public function add(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if($validator->fails()){
            return redirect('/admin/category/manager')
                ->withInput()
                ->withErrors($validator);
        } 
        $category=new Category;
        $category->name=$request->name;
        $category->save();
        
        $categories=Category::all();
        return redirect('/admin/category/manager');
        //$message['text']="Category was created successfully";
        //return view('categoriesList',['message'=>'Category was created successfully','categories'=>$categories]);
    }
    public function category($name_category)
    {
        $items=Item::where('category',$name_category)
            ->paginate(5);
        return view('categoriesList',['name_category'=>$name_category,'items'=>$items]);
    }
}