<?php

namespace App\Livewire;

use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\SavePost;
use Livewire\Component;
use App\Models\Group as ModelGroup;
use DB;

class Group extends Component
{
    public $uuid ;
    public $paginate_no =10;
    public function mount($uuid) {
        $this->uuid = $uuid ;
        
    }
    public function join($id)  {
        $group = ModelGroup::findOrFail($id);
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
        $group = ModelGroup::findOrFail($id);
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
    // save post
    public function savePost($post_id) {
        DB::beginTransaction();
        try {
            SavePost::create([
                'user_id'=>auth()->id(),
                'post_id'=>$post_id,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Save post successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function unsavePost($post_id) {
        DB::beginTransaction();
        try {
            SavePost::where([
                'user_id'=>auth()->id(),
                'post_id'=>$post_id,
            ])->first()->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Unsave post successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function render()
    {
        $group = ModelGroup::where('uuid',$this->uuid)->firstOrFail();

        $post_ids = Post::where('group_id',$group->id)->pluck('id');
        $post_media = PostMedia::whereIn('post_id',$post_ids)->where('file_type','image')->get();

        return view('livewire.group',[
            'group'=>ModelGroup::where('uuid',$this->uuid)->firstOrFail(),
            'posts'=>Post::where('group_id',$group->id)->with('user')->latest()->paginate($this->paginate_no),
            'post_media'=>$post_media
        ])->extends('layouts.app');
    }
}
