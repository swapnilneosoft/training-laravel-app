<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'value'];

    public function getAdminEmail()
    {
        $email = Configuration::get()->where('title','admin_email')->first();
        if($email)
        {
            return $email->value;
        }
        return $email;
    }

    public function getNotificationEmail()
    {
        $email = Configuration::get()->where('title','notification_email')->first();
        return $email->value;
    }
}
