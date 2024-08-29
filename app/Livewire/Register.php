<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation , $message;

    public function register()
    {
        // dd($this->name, $this->email, $this->password, $this->password_confirmation);
        $this->validate([
        'name' => 'required',
         'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
        ]);

         $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        auth()->login($user);

        // $this->message="Your account has been created successfully. Please login to continue";

        return redirect('/ ');

    }

     #[Layout("components.layouts.app")]
    public function render()
    {
        return view('livewire.register');
    }
}
