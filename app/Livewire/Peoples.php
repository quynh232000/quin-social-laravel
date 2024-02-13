<?php

namespace App\Livewire;

use App\Models\Friend;
use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class Peoples extends Component
{
    use WithPagination;
    public $paginator = 10;
    public $search;
    public function addfriend($id)
    {
        $user = User::where("uuid",$id)->first();
        DB::beginTransaction();
        try {
            Friend::create([
                'user_id' => auth()->id(),
                'friend_id' => $id
            ]);
            Notification::create([
                'type'=>"friend_request",
                'user_id'=>$user->id,
                'message'=>auth()->user()->username,
                'url'=>"#",
            ]);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Friend request send to '.$user->username
        ]);
    }
    public function removefriend($id)
    {
        $user = User::where("uuid",$id)->first();
        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' => $user->id,
                'friend_id' => auth()->user()->uuid
            ])->first()->delete();
            Notification::create([
                'type'=>"friend_request",
                'user_id'=>$user->id,
                'message'=>auth()->user()->username .' cancel friend request',
                'url'=>"#",
            ]);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Cancel friend request'.$user->username
        ]);
    }
    public function acceptfriend($id)  {
        $user = User::find($id)->first();
        DB::beginTransaction();
        try {
            $req =Friend::where([
                'user_id'=>$id,
                'friend_id'=>auth()->user()->uuid
            ])->first();
            $req->status ='accepted';
            $req->save();

            Notification::create([
                'type'=>"friend_accepted",
                'user_id'=>$id,
                'message'=>auth()->user()->username .' accepted your friend request',
                'url'=>"#",
            ]);
            Notification::create([
                'type'=>"friend_accepted",
                'user_id'=>auth()->id(),
                'message'=>auth()->user()->username .' had became your friend.',
                'url'=>"#",
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Accept friend request to '.$user->username." successfully!"
        ]);
    }
    public function render()
    {
        $user = User::whereNotIn("id", [auth()->id()])
            ->where('username', 'LIKE', '%' . $this->search . '%')
            ->inRandomOrder()
            ->paginate($this->paginator, ['id','uuid', 'first_name', 'last_name', 'username', 'profile']);

        return view('livewire.peoples', [
            'users' => $user,
            'pagination' => $user->links()
        ])->extends('layouts.app');
    }
}
