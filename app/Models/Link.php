<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'id' , 'user_id', 'short_url', 'clicks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incrementClicks()
    {
        Redis::incr("link:{$this->id}");
    }

    public function getClicks()
    {
        return Redis::get("link:{$this->id}") ?? 0 ;
    }
}
