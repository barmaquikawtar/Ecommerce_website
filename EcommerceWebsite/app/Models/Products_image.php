<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_image extends Model
{
    use HasFactory;
    public $fillable=['id','article_id','name','created_at'];
}
