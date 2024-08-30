<?php
use function Livewire\Volt\{state};
state (['email' => '','password' => '']);

$login =function () {
    $this->validate([
'email' => 'required|email',
        'password' => 'required'
    ]);
        if(  auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            return redirect('/');

        }
        $this->addError('password', 'Wrong email or password');
        return redirect()->back();
};
?>


<div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
        <h1 class="text-3xl font-bold mb-4">Login </h1>
        <form wire:submit.prevent="login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="email">
                @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="password">
                @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

