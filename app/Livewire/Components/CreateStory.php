<?php

namespace App\Livewire\Components;

use App\Models\Story;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateStory extends Component
{
    use WithFileUploads;
    public $images;

    public function createstory()
    {
        $this->validate([
            "images" => "required"
        ]);
        // |image|mimes:png,jpg,jpeg
        $images = [];
        foreach ($this->images as $image) {
            $images[] = $image->store("storeis", 'public');
        }

        Story::create([
            "user_id" => auth()->id(),
            "story" => json_encode($images),
            "status" => 1,
        ]);
        unset($this->images);
        return redirect("/");
    }
    public function render()
    {
        return view('livewire.components.create-story')->extends('layouts.app');
    }
}
