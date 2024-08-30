<?php

// namespace App\Livewire;

// use Livewire\Component;

// class Login extends Component
// {

//     public $email, $password;
//     protected $rules=[
//         'email' => 'required|email',
//         'password' => 'required'
//     ];
//     public function login()
//     {
//         $this->validate();
//         if(  auth()->attempt(['email' => $this->email, 'password' => $this->password])){
//             return redirect('/');

//         }
//         $this->addError('password', 'Wrong email or password');
//         return redirect()->back();

//     }
//     public function render()
//     {
//         return view('livewire.login');
//     }
// }
