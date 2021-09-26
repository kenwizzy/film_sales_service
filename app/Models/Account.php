<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'balance'
    ];

    protected static function booted()
    {
        // Create a uuid when a new Account is created
        static::creating(function ($account) {
            $account->uuid = (string) Str::uuid();
        });
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
