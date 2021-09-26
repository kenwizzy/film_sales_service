<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'purchase_reference',
        'status',
        'user_id',
        'amount'
    ];

   protected $casts = ['item' => 'json'];

   public function user(){
       return $this->belongsTo(User::class);
   }
}
