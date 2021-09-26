<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre_id',
        'description',
        'price',
        'status'
    ];

    protected static function booted()
    {
        // Create a uuid when a new User is to be created
        static::creating(function ($film) {
            // Create a Unique User uuid id
            $film->uuid = (string) Str::uuid();
        });
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
