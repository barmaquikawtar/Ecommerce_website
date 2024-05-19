<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statics_category extends Model
{
    use HasFactory;
    public $table='statics_category';
    public $fillable=['id','child_category','created_at'];
    public $timestamps=false;
    public function category(){
        return $this->hasOne(Child_category::class,'id','child_category');
    }
}
