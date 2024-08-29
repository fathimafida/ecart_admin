<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{

    public $email, $password;
    protected $rules=[
        'email' => 'required|email',
        'password' => 'required'
    ];
    public function login()
    {
        $this->validate();
        auth()->attempt(['email' => $this->email, 'password' => $this->password]);
        return redirect('/');

    }
    public function render()
    {
        return view('livewire.login');
    }
}
