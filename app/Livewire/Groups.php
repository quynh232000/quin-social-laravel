<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use Livewire\Component;
use DB;

class Groups extends Component
{
    public $paginate_no =8;
    public $search ="";
    public $listeners= [
        'load-more'=>'loadMore'
    ];
    public function loadMore() {
        $this->paginate_no = $this->paginate_no +4;
    }
    public function join($id)  {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            GroupMember::create([
                'user_id'=>auth()->id(),
                'group_id'=>$id
            ]);
            $group->members +=1;
            $group->save();
            Notification::create([
                'type'=>"follow_page",
                'from_user_id'=>auth()->id(),
                'user_id'=>$group->user_id,
                'message'=>auth()->user()->username. ' join your group '.$group->name,
                'url'=>'#'
            ]);
    
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has joined group '.$group->name.' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

    }
    public function leave($id)  {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            $group->members -=1;
            $group->save();
            $groupMember = GroupMember::where([
                'user_id'=>auth()->id(),
                'group_id'=>$id
            ]);
            $groupMember->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has left group '.$group->name.' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

    }
    public function render()
    {
        $count = null;
        if($this->search){
            $count = Group::where('name','like','%'.$this->search.'%')->count();
        }
        return view('livewire.groups',[
            'groups'=>Group::where('name','like','%'.$this->search.'%')->orderBy('members')->paginate($this->paginate_no),
            'count'=>$count
        ])->extends('layouts.app');
    }
}
