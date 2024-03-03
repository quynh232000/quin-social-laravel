<?php

namespace App\Livewire\Settings;

use App\Models\Social;
use Livewire\Component;

class AccountSocial extends Component
{
    public $Facebook;
    public $Twitter;
    public $Linkedin;
    public $Instagram;
    public $Github;
    public $Google;
    public function mount()
    {
        $social = Social::where('user_id', auth()->id())->first();
        if ($social) {
            $this->Facebook = $social->Facebook;
            $this->Twitter = $social->Twitter;
            $this->Linkedin = $social->Linkedin;
            $this->Instagram = $social->Instagram;
            $this->Github = $social->Github;
            $this->Google = $social->Google;
        }

    }
    public function save()
    {
        // $this->validate([
        //     'Facebook' => "sometimes|url",
        //     'Twitter' => "sometimes|url",
        //     'Linkedin' => "sometimes|url",
        //     'Instagram' => "sometimes|url",
        //     'Github' => "sometimes|url",
        //     'Google' => "sometimes|url",
        // ]);
        // $social = Social::where('user_id',auth()->id());

        Social::updateOrCreate(
            [
                'user_id' => auth()->id()
            ]
            ,
            [
                'user_id' => auth()->id(),
                'Facebook' => $this->Facebook,
                'Twitter' => $this->Twitter,
                'Linkedin' => $this->Linkedin,
                'Instagram' => $this->Instagram,
                'Github' => $this->Github,
                'Google' => $this->Google
            ]
        );
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Update your link socials has been successfully!'
        ]);
        // return redirect()->route('settings.accountsocial');

    }
    public function render()
    {
        return view('livewire.settings.account-social')->extends('layouts.app');
    }
}
