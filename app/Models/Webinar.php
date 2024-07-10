<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    protected $guarded = [];

    use HasFactory;

    //webinar user
    public function users()
    {
        return $this->belongsToMany(User::class, 'partisipant_webinar', 'webinar_id', 'user_id')
        ->withPivot('info','bukti_follow','bukti_share','next_idea')
        ->withTimestamps();
    }
}
