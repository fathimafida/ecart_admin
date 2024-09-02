<?php

use Livewire\Volt\Component;
use  App\Models\Product;
new class extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::latest()->get();
    }

};
?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="max-w-sm mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                <img class="h-30  w-30 object-cover rounded-2xl" src="{{ $product->image }}" alt="{{ $product->name }}"/>
                <p class="text-gray-700 text-base">
                    {{ $product->description }}
                </p>
                <p class="text-gray-700 text-base">
                    Price:{{ $product->price }}
                </p>
                <p class="text-gray-700 text-base">
                    Slug:{{ $product->slug }}
                </p>
                <p class="text-gray-700 text-base">
                    Stock:{{ $product->stock }}
                </p>
            </div>
        </div>
    @endforeach
</div>

