<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\Friend;
use App\Models\Like;
use App\Models\PageLike;
use App\Models\Page as ModelPage;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\SavePost;
use Livewire\Component;

use App\Models\Notification;
use DB;

class Page extends Component
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
    }
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
    public function follow($id)  {
        $page = ModelPage::findOrFail($id);
        DB::beginTransaction();
        try {
            PageLike::create([
                'user_id'=>auth()->id(),
                'page_id'=>$id
            ]);
            $page->members +=1;
            $page->save();
            Notification::create([
                'type'=>"follow_page",
                'from_user_id'=>auth()->id(),
                'user_id'=>$page->user_id,
                'message'=>auth()->user()->username. ' followed your page '.$page->name,
                'url'=>'#'
            ]);
    
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has followed '.$page->name.' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

    }
    public function unfollow($id)  {
        $page = ModelPage::findOrFail($id);
        DB::beginTransaction();
        try {
            $page->members -=1;
            $page->save();
            $pagelike = PageLike::where([
                'user_id'=>auth()->id(),
                'page_id'=>$id
            ]);
            $pagelike->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has unfollowed '.$page->name.' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

    }
    public function togle() {
        $this->loader = !$this->loader;
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
        $page = \App\Models\Page::where('uuid',$this->uuid)->firstOrFail();
        $post_ids = Post::where('page_id',$page->id)->pluck('id');
        $posts =  Post::where('page_id',$page->id)->with('user')->latest()->paginate($this->paginate_no);
        $post_media = PostMedia::whereIn('post_id',$post_ids)->where('file_type','image')->get();
        return view('livewire.page',[
            'page'=>$page,
            'posts'=>$posts,
            'post_media'=>$post_media
        ])->extends('layouts.app');
        
    }
    
    
}
