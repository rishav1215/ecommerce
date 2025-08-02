<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Str;

class AdminProductController extends Controller
{
        public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
         $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only('name', 'price', 'description');

    // Image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $filename);
        $data['image'] = $filename;
    }

    Product::create($data);

    return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.products.edit', compact('product'));
}


public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $imageName);
        $product->image = $imageName;
    }

    $product->save();
    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
}
public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Image delete from storage
    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
        unlink(public_path('uploads/products/' . $product->image));
    }

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}


public function showUsers()
{
    $users = User::latest()->get();
    return view('admin.users', compact('users'));
}


}
