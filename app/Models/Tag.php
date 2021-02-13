<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,     // Related Model
            'product_tag',      // Pivot Table
            'tag_id',           // F.K. in the pivot table for the current model
            'product_id',       // F.K. in the pivot table for related model
            'id',               // P.K in the current model
            'id'                // P.K. in the related model
        );
    }
}
