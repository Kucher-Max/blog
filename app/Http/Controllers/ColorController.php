<?php

namespace App\Http\Controllers;
use App\Faker\Factory as Faker;
use App\Category;
use Validator;
use App\Tag;
use App\TagItem;
use App\Item;
use App\Comment;
use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function color()
    {
        $back=Color::first();
        return view('color',['color'=>$back]);
    }
}