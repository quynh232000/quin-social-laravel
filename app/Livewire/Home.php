<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\Friend;
use App\Models\Like;
use App\Models\User;
use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;
use DB;


class Home extends Component
{
    public $paginate_no = 20;
    public $comment;
    public function saveComment($post_id)  {
        $this->validate([
            'comment' => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comments::firstOrCreate([
                'post_id'=>$post_id,
                'user_id'=>auth()->id(),
                'comment'=>$this->comment
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments +=1;
            $post->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
        unset($this->comment);
    }
    public function like($id)  {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(['post_id'=>$id,'user_id'=>auth()->id()]);
            $post = Post::findOrFail($id);
            $post->likes +=1;
            $post->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function dislike($id)  {
        DB::beginTransaction();
        try {
            $like =Like::firstOrCreate(['post_id'=>$id,'user_id'=>auth()->id()])->first();
            $like->delete();
            $post = Post::findOrFail($id);
            $post->likes -=1;
            $post->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function acceptfriend($id)  {
        // dd($id);
        $user = User::where('id',$id)->first();
       
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
    public function rejectfriend($id)
    {
       
        $user = User::where("id",$id)->first();
        
        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' => $id,
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
    
    public function render()
    {
        
        return view('livewire.home',[
            'posts'=> Post::with('user')->latest()->paginate($this->paginate_no),
            'friend_requests'=> Friend::where(['friend_id'=>auth()->user()->uuid,'status'=>'pending'])->with('friend')
            ->join('users','users.id','=','friends.user_id')
            ->take(5)->get()
            ])->extends('layouts.app');
            
    }
}
