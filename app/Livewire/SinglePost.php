<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use DB;

class SinglePost extends Component
{
    public $paginate_no =20;
    public $user_uuid;
    public $post_uuid;
    public function mount($useruuid, $postuuid)  {
        $this->user_uuid = $useruuid;
        $this->post_uuid = $postuuid;
    }
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
            unset($this->comment);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
        
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
        $user = User::where(['uuid'=>$this->user_uuid])->first();
        $post = Post::where(['user_id'=>$user->id,'uuid'=>$this->post_uuid])->with(['user','comment'])->first();
        // dd($post);
        return view('livewire.single-post', [
            'post'=> $post
        ])->extends('layouts.app');
    }
}
