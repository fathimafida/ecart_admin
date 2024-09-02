<?php

use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', Home::class)->name('home');
Volt::route('/','home')->name('home');
// Route::get('/register', Register::class)->name('register');
Volt::route('/register','register')->name('register');
// Route::get('/login', Login::class)->name('login');
Volt::route('/login','login')->name('login');

Volt::route('/product', 'add-product')->name('add-product');


