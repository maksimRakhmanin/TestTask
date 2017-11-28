<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Item;
use App\Category_item;


class AdminController extends Controller
{
    //
    public function show()
    {

        $category_items = Category_item::all();
        $items = Item::all();
        $categories = Category::all();

        return view('admin', ['categories' => $categories, 'items' => $items,'category_items'=>$category_items]);
    }

    public function post_show(Request $request)
    {

        if ($request->isMethod('post')) {
            if (Input::has('addCategory')) {
                $rules = ['category' => 'required|unique:categories|min:3|max:25'];
                $this->validate($request, $rules);
                $category = new Category();
                $category->category = $request->category;
                $category->save();
                return redirect()->back()->with('success_category', 'Категория добавлена в список');

            }
            if (Input::has('addItem')) {
                $rules = ['item' => 'required|unique:items|min:3|max:25', 'info' => 'min:6', 'image' => 'image'];
                $this->validate($request, $rules);
                $categories = Category::all();
                foreach ($categories as $category) {
                    if (Input::has('check_' . $category->id)) { //если выбрана категория в chackbox
                        $cat_item = new Category_item();
                        $cat_item->category_id = Input::get('check_' . $category->id);
                        $item = new Item();
                        $item->item = $request->item;
                        $item->info = $request->info;
                        $item->save();
                        $cat_item->item_id = $item->id;
                        $cat_item->save();
                    }

                }

                return redirect()->back()->with('success_item', 'Товар успешно добавлен в каталог');
            }
            if (Input::has('del_category')) {
                $cat = Category::all();
                foreach ($cat as $cat_id) {
                    if ($request->click_category == $cat_id->id) {
                        Category::destroy($cat_id->id);
                    }
                }
                return redirect()->back()->with('deleted', 'Категория удалена');
            }
            if ($request->ajax()) {
                $categories = Category::all();
                foreach ($categories as $category) {
                    if ($request->id_cat == $category->id) {
                        $cat = Category::find($category->id);
                        $item_select = $cat->items;
                       return response()->json(['item' => $item_select]);
                    }

                }

            }
            $items = Item::all();
            foreach($items as $item){
                if(Input::has('delete_'.$item->id)){
                    Item::destroy($item->id);
                    return redirect()->back()->with('deleted','Товар удален');
                }
            }
        }


    }



}
