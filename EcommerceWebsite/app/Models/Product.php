<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = ['id', 'child_category_id', 'statut', 'title','presentation' ,'company_id', 'specification',
        'Technical_sheet', 'colors', 'quantity', 'price', 'created_at'];

    public function childcategory()
    {
        return $this->belongsTo(Child_category::class,'child_category_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function images()
    {
        return $this->hasMany(Products_image::class,'article_id');
    }
    public function colors()
    {
        return $this->hasMany(Color::class,'product_id');
    }
    public function topproducts(){
        return $this->hasOne(Best_product::class,'products_id');
    }
    public function pane(){
        return $this->hasMany(Pane::class,'product_id');
    }
    public function commandeitems(){
        return $this->hasMany(Commandeitem::class,'product_id','id');
    }
}
