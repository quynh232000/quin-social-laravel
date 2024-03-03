<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Settings extends Component
{

    public function logout()  {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
    public function render()
    {
        return view('livewire.settings')->extends('layouts.app');
    }
}
