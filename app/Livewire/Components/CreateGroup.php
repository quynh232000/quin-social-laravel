<?php

namespace App\Livewire\Components;

use App\Models\Group;
use App\Models\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use DB;
use Str;

class CreateGroup extends Component
{
    use WithFileUploads;
   public $name;
   public $location;
   public $type;
   public $icon;
   public $thumbnail;
   public $decription;

    public function creategroup()  {
        $this->validate([
           "name"=>"required|string",
           "location"=>"required|string",
           "type"=>"required|string",
           "icon"=>"required|image",
           "thumbnail"=>"required|image",
           "decription"=>"required|string",
        ]);

        DB::beginTransaction();
        try {
            $page = Group::create([
                'uuid'=>Str::uuid(),
                'user_id'=>auth()->id(),
                'icon'=>$this->icon->store('pages','public'),
                'thumbnail'=>$this->thumbnail->store('groups','public'),
                'description'=>$this->decription,
                'name'=>$this->name,
                'location'=>$this->location,
                'type'=>$this->type
            ]);
            Notification::create([
                'type'=>"craete_page",
                'user_id'=>auth()->id(),
                'message'=>"Group ".$this->name. ' has been created successfully!',
                'url'=>route('page',$page->uuid)
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => "Group ".$this->name.' has been created successfully!'
            ]);

            DB::commit();
            

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return to_route('group',$page->uuid);
    }

    public function render()
    {
        
        return view('livewire.components.create-group')->extends('layouts.app');
    }
}
