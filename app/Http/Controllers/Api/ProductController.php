<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::all();
        return response()->json([
            "user"=>$request->user(),
            "products"=>$products
        ]);
    }

    public function addProduct(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|numeric|min:0',
            'image' => 'required|image|max:1024|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
        ]);

        // Store the image in the public directory
        $imagePath = $request->file('image')->store('images', 'public');


      $product=  Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id,
        ]);

        $product->tags()->attach($request->tags);
        return response()->json($product);

    }
    public function editProduct(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,'.$id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|numeric|min:0',
            'image' => 'sometimes|image|max:1024|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
        ]);

        $product =  Product::find($id);
        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }
        // Store the image in the public directory

      if($request->hasFile('image')){
            Storage::disk('public')->delete($product->image);
            $imagePath = $request->file('image')->store('images', 'public');
        }else{
            $imagePath = $product->image;
        }



       $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id,
        ]);

        $product->tags()->sync($request->tags);
        return response()->json($product);

    }

    public function deleteProduct( $id){
         $product = Product::find($id);
         $product->delete();
         return response()->json($product);
    }
}
