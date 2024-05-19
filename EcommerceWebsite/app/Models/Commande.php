<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    public $fillable=['id','client_id','statut','total','created_at'];
    public function items(){
        return $this->hasMany(Commandeitem::class,'commade_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}
