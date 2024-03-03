<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\Page;
use App\Models\PageLike;
use Livewire\Component;
use DB;
class Pages extends Component
{
    public $paginate_no = 9;
    public $search ="";
    public $listeners= [
        'load-more'=>'loadMore'
    ];
    public function loadMore() {
        $this->paginate_no = $this->paginate_no +6;
    }
    // public function search() {
        
    // }
    public function follow($id)  {
        $page = Page::findOrFail($id);
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
        $page = Page::findOrFail($id);
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
    public function render()
    {
        $count = null;
        if($this->search){
            $count = Page::where('name','like','%'.$this->search.'%')->count();
        }
        return view('livewire.pages',[
            'pages'=>Page::where('name','like','%'.$this->search.'%')->orderBy('members')->paginate($this->paginate_no),
            'count'=>$count
        ])->extends('layouts.app');
    }
}
