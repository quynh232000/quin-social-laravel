<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'mobile_verification_code',
        'email_verified_at',
        'mobile_verified_at',
        'description',
        'thumbnail',
        'profile',
        'relationship',
        'location',
        'address',
        "gender",
        'is_private',
        'is_banned',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function is_friend()
    {
        return ((Friend::where(['user_id'=>$this->id])->orWhere('friend_id',$this->uuid)->first())->status  ?? "");
    }


    public function mutual_friends()
    {
        $my_friend_friends = Friend::where("user_id", $this->id)->OrWhere("friend_id", $this->id)->pluck("id")->toArray();
        $my_friend = Friend::where("user_id", auth()->id())->OrWhere("friend_id", auth()->id())->pluck("id")->toArray();
        return count(array_intersect($my_friend, $my_friend_friends));
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
