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
        'fee',
        'image_path',
        'wa_group_url',
    ];

    // bootcamp user
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
