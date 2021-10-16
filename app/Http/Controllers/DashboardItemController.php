<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $caption = "";
        if (request(['category'])) {
            $category = Category::firstWhere('slug', request('category'));
            $caption = "by Category : " . $category->name;
        }
        return view('dashboard/items/index', [
            "title" => "Daftar Item ",
            "caption" => $caption,
            "daftaritem" => Item::filter(request(['search', 'category']))->paginate(15)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/items/create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'slug' => 'required|unique:items',
            'image' => 'image|file|max:3024',
            'category_id' => 'required',
            'satuan' => 'required|max:24|string',
            'harga' => 'required|digits_between:1,10'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('item-img');
        }

        Item::create($validatedData);

        return redirect('/dashboard/items/')->with('succesAddItem', 'A new Item has been Added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('dashboard/items/detail', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('dashboard/items/edit', [
            'item' => $item,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $rules = [
            'name' => 'required|max:50',
            'category_id' => 'required',
            'satuan' => 'required|max:24|string',
            'image' => 'image|file|max:3024',
            'harga' => 'required|digits_between:1,10'
        ];

        if ($request->slug != $item->slug) {
            $rules['slug'] = 'required|unique:items';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('item-img');
        }

        Item::where('id', $item->id)->update($validatedData);

        return redirect('/dashboard/items/')->with('succesAddItem', 'An Item has been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::delete($item->image);
        }

        Item::destroy($item->id);
        return redirect('/dashboard/items/')->with('succesAddItem', 'An Item has been Deleted !');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Item::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
