<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'pirthday','gender',
        'street_address', 'city', 'state', 'postl_code', 'cauntry','locale'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
