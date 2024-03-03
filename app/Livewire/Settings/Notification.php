<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Notification extends Component
{
    public $paginator_no = 20;
    public function render()
    {
        return view('livewire.settings.notification',[
            'notifications'=>\App\Models\Notification::where('user_id',auth()->id())->with('fromuser')->latest()->paginate($this->paginator_no),
            'count'=>\App\Models\Notification::where(['user_id'=>auth()->id(),'read_at'=>null])->count()


        ])->extends('layouts.app');
    }
}
