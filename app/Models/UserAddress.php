<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=[
        "user_id",
        "fullname",
        "address",
        "state","city","pincode","mobile_no","status"
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
