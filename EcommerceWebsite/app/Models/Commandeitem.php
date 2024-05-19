<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandeitem extends Model
{
    use HasFactory;
    public $fillable=['commade_id','product_id','color_id','quantity','created_at'];
    public function pane(){
        return $this->belongsTo(Pane::class,'pane_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function color(){
        return $this->belongsTo(Color::class,'color_id');
    }
}
