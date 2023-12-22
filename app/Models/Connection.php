<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'request_id',
        'friend_id',
    ];

    public function users(){
        return $this->belongsTo(User::class,'friend_id','id');
    }
}
