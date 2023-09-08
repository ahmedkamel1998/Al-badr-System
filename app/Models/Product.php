<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    protected $fillable = [

        'Product_name',
        'section_id',
        'description',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(section::class);
    }

    public static function getName($id)
    {
        $product = Product::find($id);
        return $product->name;
        dd($product);
    }

    // protected $guarded = [];

    use HasFactory;
}
