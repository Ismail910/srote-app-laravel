<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'img',
        'status',
        'description'
    ];

      public function products(){
        return $this->hasMany(product::class, 'srore_id', 'id');
      }
}
