<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    protected $casts = [
        'datetime' => 'datetime'
    ];
    
    protected $fillable = [
        'title',
        'description',
        'identifier',
        'datetime',
        'place',
        'fee',
        'image_path',
        'video_url',
        'meet_url',
        'poster_url',
    ];

    use HasFactory;

    //webinar user
    public function users(){
        return $this->belongsToMany(User::class, 'partisipant_webinar', 'webinar_id', 'user_id');
    }
    
}
