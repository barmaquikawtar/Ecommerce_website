<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table="categories";
    public $fillable=['id','name','created_at'];
    public function child_categories(){
        return $this->hasMany(Child_category::class,'category_id');
    }
}
