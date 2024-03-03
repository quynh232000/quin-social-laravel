<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\SavePost;
use App\Models\User as ModelUser;
use Livewire\Component;
use App\Models\Friend;
use App\Models\Notification;
use Livewire\WithPagination;
use DB;

class User extends Component
{
    public $paginate_no = 10;
    public $uuid;
    public $loader;
    public $comment;
    public $listeners= [
        'load-more'=>'loadMore'
    ];
    public function loadMore() {
        $this->paginate_no = $this->paginate_no +4;
    }
    public function mount($uuid)  {
        $this->uuid = $uuid;
        $this->loader = 1;
    }
    public function addfriend($id)
    {
        $user = ModelUser::where("uuid",$id)->first();
        DB::beginTransaction();
        try {
            Friend::create([
                'user_id' => auth()->id(),
                'friend_id' => $id
            ]);
            Notification::create([
                'type'=>"friend_request",
                'from_user_id'=>auth()->id(),
                'user_id'=>$user->id,
                'message'=>auth()->user()->username."has send you a friend request!",
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
    public function rejectfriend($id)
    {
        $user = ModelUser::where("uuid",$id)->first();
        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' =>$user->id ,
                'friend_id' => auth()->user()->uuid
            ])->first()->delete();
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
    public function removefriend($id)
    {
        $user = ModelUser::where("uuid",$id)->first();
        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' =>auth()->id() ,
                'friend_id' => $id
            ])->first()->delete();
            Notification::create([
                'type'=>"friend_request",
                'from_user_id'=>auth()->id(),
                'user_id'=>$user->id,
                'message'=>auth()->user()->username .' cancel your friend request',
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
        $user = ModelUser::find($id)->first();
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
                'from_user_id'=>auth()->id(),
                'user_id'=>$id,
                'message'=>auth()->user()->username .' accepted your friend request',
                'url'=>"#",
            ]);
            Notification::create([
                'type'=>"friend_accepted",
                'from_user_id'=>$id,
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
    public function togle() {
        $this->loader = !$this->loader;
    }// save post
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
        $user = ModelUser::where('uuid',$this->uuid)->firstOrFail();
        $post_ids = Post::where(['is_group_post'=>0,"is_page_post"=>0])->where('user_id',$user->id)->with('user')->pluck('id');
        $posts =  Post::where(['is_group_post'=>0,"is_page_post"=>0])->where('user_id',$user->id)->with('user')->latest()->paginate($this->paginate_no);
        if($this->loader ==1){
            $post_media = PostMedia::whereIn('post_id',$post_ids)->where('file_type','image')->get();
            return view('livewire.user',[
                'user'=>$user,
                'posts'=>$posts,
                'post_media'=>$post_media
            ])->extends('layouts.app');

        }else{
            $post_media = PostMedia::whereIn('post_id',$post_ids)->pluck('post_id');

            return view('livewire.user_media',[
                'user'=>$user,
                'posts'=>$posts,
                
            ])->extends('layouts.app');
        }
    }
}
