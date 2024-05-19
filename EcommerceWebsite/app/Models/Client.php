<?php

namespace App\Models;

use App\Notifications\ClientResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable implements MustVerifyEmail

{
    use HasFactory,Notifiable ;
    public $fillable=['id','user_name','email','telephone','city','zip','adresse','password','created_at'];
    public $hidden=['password'];
    public function sendPasswordResetNotification($token)
    {
        $url = 'changepassword/token='.$token;

        $this->notify(new ClientResetPassword($url));
    }

}
