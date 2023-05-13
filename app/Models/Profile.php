<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'image', 'phone', 'address', 'gender', 'bio'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
