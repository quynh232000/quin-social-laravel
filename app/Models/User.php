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
        'thumbnial',
        'profile',
        'relationship',
        'location',
        'address',
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
