<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class SavePost extends Component
{
    public $paginator_no =20;
    public function render()
    {
        return view('livewire.settings.save-post',[
            'saveposts'=>\App\Models\SavePost::where('user_id',auth()->id())->with(['user','post'])->latest()->paginate($this->paginator_no),
            'count'=>\App\Models\SavePost::where('user_id',auth()->id())->count()
        ])->extends('layouts.app');
    }
}
