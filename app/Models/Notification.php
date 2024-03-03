<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'from_user_id',
        'user_id',
        'message',
        'url',
        'read_at'
    ];
    public function user() : BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }

    public function fromuser() : BelongsTo {
        return $this->belongsTo(User::class,'from_user_id');
    }
}
