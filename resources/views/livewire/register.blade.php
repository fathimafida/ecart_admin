<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <h1 class="text-3xl font-bold">Register</h1>
    </div>
    <form wire:submit.prevent="register">
        @if ($message)
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg " >
            <strong class="font-bold">Success</strong>
            <span class="text-green-600">{{ $message }}</span>
        </div>
        @endif
        <div class="space-y-6">
            <div>

                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" id="name" name="name" autocomplete="name" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="name" />
                    @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="email" id="email" name="email" autocomplete="email" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="email" />
                    @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" id="password" name="password" autocomplete="new-password" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="password" />
                    @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <div class="mt-1">
                    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="password_confirmation" />
                    @error('password_confirmation') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <button wire:click="register" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Register
            </button>
        </div>
    </form>
</div>

