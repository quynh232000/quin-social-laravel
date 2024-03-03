<?php

namespace App\Livewire\Components;

use App\Models\Post;
use App\Models\PostMedia;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Str;
use DB;

class CreatePost extends Component
{
    use WithFileUploads;
    public $message;
    public $images;
    public $video;
    public $groupid;
    public $pageid;
    public function mount($groupid =null,$pageid =null)
    {
        $this->groupid = $groupid ;
        $this->pageid = $pageid ;
    }
    public function createpost()
    {
        $this->validate([
            'message' => "required|string"
        ]);
        DB::beginTransaction();

        try {
            $newpost = [
                'uuid' => Str::uuid(),
                "user_id" => auth()->id(),
                "content" => $this->message,
            ];
            if ($this->groupid) {
                $newpost['group_id'] = $this->groupid;
                $newpost['is_group_post'] = 1;
            }
            if ($this->pageid) {
                $newpost['page_id'] = $this->pageid;
                $newpost['is_page_post'] = 1;
            }
            // create post 
            $post = Post::create($newpost);
            // if has media 
            if ($this->images) {
                $images = [];
                foreach ($this->images as $image) {
                    $images[] = $image->store('posts/images', 'public');
                }
                PostMedia::create([
                    'post_id' => $post->id,
                    'file_type' => 'image',
                    'file' => json_encode($images),
                    'position' => 'general'
                ]);
            }

            // $video_file_name = "";
            if ($this->video) {
                $video_file_name = $this->video->store('posts/video', 'public');
                PostMedia::create([
                    'post_id' => $post->id,
                    'file_type' => 'video',
                    'file' => $video_file_name,
                    'position' => 'general'
                ]);
            }


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }

        unset($this->message);
        unset($this->images);
        unset($this->video);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Your post has been published'
        ]);
    }
    public function render()
    {
        return view('livewire.components.create-post');
    }

}
