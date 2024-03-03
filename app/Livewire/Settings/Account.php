<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use DB;
use Str;
use App\Models\User;

class Account extends Component
{
    use WithFileUploads;
    public $first_name;
    public $last_name;
    public $mobile;
    public $email;
    public $location;
    public $address;
    public $profile;
    public $thumbnail;
    public $description;
    // public $user;
    public function mount()
    {
        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        $this->mobile = auth()->user()->mobile;
        $this->location = auth()->user()->location;
        $this->address = auth()->user()->address;
        $this->description = auth()->user()->description;
    }

    public function updateProfile()
    {
        // $this->validate([
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'location' => 'required|string|max:255',
        //     'profile' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        //     'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        // ]);
        $userinfo = User::find(auth()->id());
        $userinfo->first_name = $this->first_name;
        $userinfo->last_name = $this->last_name;

        if ($this->location) {
            $userinfo->location = $this->location;
        }
        if ($this->mobile) {
            $userinfo->mobile = $this->mobile;
        }
        if ($this->address) {
            $userinfo->address = $this->address;
        }
        if ($this->description) {
            $userinfo->description = $this->description;
        }
        if ($this->profile) {
            $userinfo->profile = $this->profile->store('profiles', 'public');
        }
        if ($this->thumbnail) {
            $userinfo->thumbnail = $this->thumbnail->store('profiles', 'public');
        }
        $userinfo->save();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Update your profile has been successfully!'
        ]);
        return redirect()->route('settings.account');

    }
    public function render()
    {
        $user = User::findOrFail(auth()->id());
        // dd($user);
        return view('livewire.settings.account')->extends('layouts.app');
    }
}
