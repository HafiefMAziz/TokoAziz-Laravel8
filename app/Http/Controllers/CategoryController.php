<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function perCategory(Category $category)
    {
        return view('daftaritem', [
            "title" => "Daftar Item - Category",
            "daftaritem" => $category->item->load('category'),
        ]);
    }
}
