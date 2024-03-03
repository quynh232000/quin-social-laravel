<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\Friend;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Like;
use App\Models\PageLike;
use App\Models\SavePost;
use App\Models\User;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Page;
use Livewire\Component;
use DB;


class Home extends Component
{
    public $paginate_no = 9;
    public $comment;
    public $hide_user_list=[];
    public $listeners = [
        'load-more' => 'loadMore'
    ];
    public function loadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }


    public function saveComment($post_id)
    {
        $this->validate([
            'comment' => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comments::firstOrCreate([
                'post_id' => $post_id,
                'user_id' => auth()->id(),
                'comment' => $this->comment
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments += 1;
            $post->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
        unset($this->comment);
    }
    public function like($id)
    {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(['post_id' => $id, 'user_id' => auth()->id()]);
            $post = Post::findOrFail($id);
            $post->likes += 1;
            $post->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(['post_id' => $id, 'user_id' => auth()->id()])->first();
            $like->delete();
            $post = Post::findOrFail($id);
            $post->likes -= 1;
            $post->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function acceptfriend($id)
    {
        // dd($id);
        $user = User::where('id', $id)->first();

        DB::beginTransaction();
        try {
            $req = Friend::where([
                'user_id' => $id,
                'friend_id' => auth()->user()->uuid
            ])->first();
            $req->status = 'accepted';
            $req->save();

            Notification::create([
                'type' => "friend_accepted",
                'from_user_id' => auth()->id(),
                'user_id' => $id,
                'message' => auth()->user()->username . ' accepted your friend request',
                'url' => "#",
            ]);
            Notification::create([
                'type' => "friend_accepted",
                'from_user_id' => $id,
                'user_id' => auth()->id(),
                'message' => auth()->user()->username . ' had became your friend.',
                'url' => "#",
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Accept friend request to ' . $user->username . " successfully!"
        ]);
    }
    public function rejectfriend($id)
    {

        $user = User::where("id", $id)->first();

        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' => $id,
                'friend_id' => auth()->user()->uuid
            ])->first()->delete();
            Notification::create([
                'type' => "friend_request",
                'from_user_id' => auth()->id(),
                'user_id' => $user->id,
                'message' => auth()->user()->username . ' cancel friend request',
                'url' => "#",
            ]);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Cancel friend request' . $user->username
        ]);
    }
    public function addfriend($id)
    {
        $user = User::where("uuid", $id)->first();
        DB::beginTransaction();
        try {
            Friend::create([
                'user_id' => auth()->id(),
                'friend_id' => $id
            ]);
            Notification::create([
                'type' => "friend_request",
                'from_user_id' => auth()->id(),
                'user_id' => $user->id,
                'message' => auth()->user()->username,
                'url' => "#",
            ]);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Friend request send to ' . $user->username
        ]);
    }
    // like unlike page
    public function likepage($id)
    {

        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {
            PageLike::create([
                'user_id' => auth()->id(),
                'page_id' => $id
            ]);
            $page->members += 1;
            $page->save();
            Notification::create([
                'type' => "follow_page",
                'from_user_id' => auth()->id(),
                'user_id' => $page->user_id,
                'message' => auth()->user()->username . ' followed your page ' . $page->name,
                'url' => '#'
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has followed ' . $page->name . ' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }
    public function unlikepage($id)
    {
        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {
            $page->members -= 1;
            $page->save();
            $pagelike = PageLike::where([
                'user_id' => auth()->id(),
                'page_id' => $id
            ]);
            $pagelike->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has unfollowed ' . $page->name . ' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }
    // join and leave group
    public function join($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            GroupMember::create([
                'user_id' => auth()->id(),
                'group_id' => $id
            ]);
            $group->members += 1;
            $group->save();
            Notification::create([
                'type' => "follow_page",
                'from_user_id' => auth()->id(),
                'user_id' => $group->user_id,
                'message' => auth()->user()->username . ' join your group ' . $group->name,
                'url' => '#'
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has joined group ' . $group->name . ' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }
    public function leave($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            $group->members -= 1;
            $group->save();
            $groupMember = GroupMember::where([
                'user_id' => auth()->id(),
                'group_id' => $id
            ]);
            $groupMember->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'You has left group ' . $group->name . ' successfully!'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }
    // read notifications
    function readNotifications()
    {
        dd("okok");
    }
    // save post
    public function savePost($post_id)
    {
        DB::beginTransaction();
        try {
            SavePost::create([
                'user_id' => auth()->id(),
                'post_id' => $post_id,
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

    public function unsavePost($post_id)
    {
        DB::beginTransaction();
        try {
            SavePost::where([
                'user_id' => auth()->id(),
                'post_id' => $post_id,
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
    // hidden all post from 
    
    public function hide_all_from($type,$id)  {
        if($type =='user'){
            $user = User::findOrFail($id);
            $friendship = Friend::where('user_id',$id)->orWhere('friend_id',$user->uuid)->first();
            if($friendship){
                $friendship->status = "rejected";
                $friendship->save();
            }else{
                $hide_user_list[] = $id;
            }
        }elseif($type =='group'){
            $member = GroupMember::where(['group_id'=>$id,'user_id'=>auth()->id()]);
            if($member){
                $member->status = 'inactive';
                $member->save();
            }
        }elseif($type =='page'){
            $member = PageLike::where(['page_id'=>$id,'user_id'=>auth()->id()]);
            if($member){
                $member->status = 'inactive';
                $member->delete();
            }
        }
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Hidden all post '.$type.' successfully!'
        ]);
    }

    public function render()
    {
        $my_groups = GroupMember::where('user_id',auth()->id())->pluck('group_id');
        $my_pages = PageLike::where('user_id',auth()->id())->pluck('page_id');
        $my_friends = [];
        $friend_ids = [];
        // get suggestion friends
        $friend_ids_all = Friend::where('user_id', auth()->id())
            ->orWhere('friend_id', auth()->user()->uuid)
            ->get(['user_id', 'friend_id'])->toArray();
        foreach ($friend_ids_all as $item) {
            if($item['user_id'] == auth()->id()){
                $my_friends[] = User::where('uuid',$item['friend_id'])->firstOrFail()->id;
                $friend_ids[]=$item['friend_id'];
            }else{
                $my_friends[] = $item['user_id'];
                $friend_ids[]=$item['user_id'];
            }
        }
        // get all my friend,page,group ids 

        // get all posts
        $post = Post::whereIn('group_id',$my_groups)
        ->orWhereIn('page_id',$my_pages)
        ->orWhereIn('user_id',$my_friends)
        ->with(['user','page','group'])->latest()->paginate($this->paginate_no);
        // group suggestion
        $suggested_group = Group::with('user')->inRandomOrder()->limit(2)->get();

        $suggested_users = User::where(function ($query) use ($friend_ids) {
            $query->whereNotIn('id', $friend_ids)
                ->whereNotIn('uuid', $friend_ids);
        })->limit(4)->get();

        return view('livewire.home', [
            // where(['is_group_post' => 0, "is_page_post" => 0])->
            'posts' => $post,
            'friend_requests' => Friend::where(['friend_id' => auth()->user()->uuid, 'status' => 'pending'])->with('friend')
                ->join('users', 'users.id', '=', 'friends.user_id')
                ->take(5)->get(),
            "suggested_pages" => Page::with('user')->inRandomOrder()->limit(2)->get(),
            "suggested_groups" => $suggested_group,
            'suggested_users' => $suggested_users
        ])->extends('layouts.app');

    }
}
