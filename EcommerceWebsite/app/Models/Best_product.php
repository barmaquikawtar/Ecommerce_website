<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Best_product extends Model
{
    use HasFactory;

    public $fillable = ['id', 'products_id', 'created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
