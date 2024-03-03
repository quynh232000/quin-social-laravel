<?php

namespace App\Livewire\Settings;
use App\Models\Faq;

use Livewire\Component;

class Help extends Component
{
    public $search ="" ;
    public $paginatior_no = 20;
    public function render()
    {
        return view('livewire.settings.help',[
            'helps'=>Faq::where(function ($query) {
                $query->where('question','like','%'.$this->search.'%')
                ->orWhere('answer','like','%'.$this->search.'%');
            })->latest()->paginate($this->paginatior_no)
        ])->extends('layouts.app');
    }
}
