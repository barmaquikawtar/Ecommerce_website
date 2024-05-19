<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child_category extends Model
{
    use HasFactory;
    public $table="child_categories";
    public $fillable=['id','name','category_id','created_at'];
    public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function statics(){
        return $this->belongsTo(Statics_category::class,'id','child_category');

    }
}
