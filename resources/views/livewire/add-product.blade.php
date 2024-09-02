<?php

use Livewire\Volt\Component;
use  App\Models\Product;
use Livewire\WithFileUploads;
new class extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $category_id = 1;

    public function addProduct()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|max:1024',
        ]);

        // Store the image in the public directory
        $imagePath = $this->image->store('images', 'public');


        Product::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imagePath,
            'user_id' => auth()->user()->id,
            'category_id' => $this->category_id,
        ]);

        return redirect()->to('/');
    }


};
?>

<div class="max-w-md mx-auto p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-bold mb-4">Add Product</h2>

    <form wire:submit.prevent="addProduct">

       <div class="mb-4">
        <label for="name" class="block text-gray-700">Product Name</label>
        <input type="text" id="name" wire:model="name" class="w-full p-2 border border-gray-300 rounded">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea id="description" rows="6" wire:model="description" class="w-full p-2 border border-gray-300 rounded"></textarea>
        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>


     <div
            class="mb-4">
            <label for="image" class="block text-gray-700 ">Image</label>
            <input type="file" wire:model="image">
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price</label>
            <input type="text" id="price" wire:model="price" class="w-full p-2 border border-gray-300 rounded">
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label for="slug" class="block text-gray-700">Slug</label>
            <input type="text" id="slug" wire:model="slug" class="w-full p-2 border border-gray-300 rounded">
            @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>





        <div class="mb-4">
            <label for="stock" class="block text-gray-700">Stock</label>
            <input type="number" id="stock" wire:model="stock" class="w-full p-2 border border-gray-300 rounded">
            @error('stock') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Product</button>
    </form>

</div>

