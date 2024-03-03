<?php

namespace App\Livewire;

use App\Models\PostMedia;
use Livewire\Component;

use App\Models\Comments;
use App\Models\Friend;
use App\Models\Like;
use App\Models\User;
use App\Models\Notification;
use App\Models\Post;
use DB;

class VideoPosts extends Component
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
    public function render()
    {

        $postids = PostMedia::where('file_type',"video")->latest()->pluck("post_id");
        $posts =Post::whereIn('id',$postids)->with('user')->latest()->paginate($this->paginate_no);
        
        
        return view('livewire.video-posts',[
            'posts'=> $posts
            ])->extends('layouts.app');
    }
}
