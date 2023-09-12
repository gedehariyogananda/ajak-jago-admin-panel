<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date_reg',
        'end_date_reg',
        'time_long',
        'place',
        'identifier',
        'fee',
        'image_path',
        'wa_group_url',
    ];

    // bootcamp user
    public function users()
    {
        return $this->belongsToMany(User::class,'bootcamp_participant','bootcamp_id','user_id')
        ->withPivot('jurusan','description','pengembangan', 'ekspetasi','file_cv','bukti_follows', 'bukti_shared')
        ->withTimestamps();
    }
}
