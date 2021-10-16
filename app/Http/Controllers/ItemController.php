<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{

    public function index()
    {
        $caption = "";
        if (request(['category'])) {
            $category = Category::firstWhere('slug', request('category'));
            $caption = "by Category : " . $category->name;
        }
        return view('daftaritem', [
            "title" => "Daftar Item ",
            "caption" => $caption,
            "daftaritem" => Item::filter(request(['search', 'category']))->paginate(12)->withQueryString(),
        ]);
    }

    public function detail(Item $item)
    {
        return view('detailitem', [
            "title" => "Detail item",
            "item" => $item
        ]);
    }
}
