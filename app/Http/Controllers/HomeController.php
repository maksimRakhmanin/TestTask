<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Category_item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::pluck('id')->all();

        $item = Item::pluck('id')->all();
        $items = Item::find($item);
        $categories = Category::all();
        return view('home',['categories'=>$categories,'items'=>$items]);
    }

}
