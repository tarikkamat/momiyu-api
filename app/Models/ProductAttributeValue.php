<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_values';

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    protected $fillable = [
        'value',
        'attribute_id'
    ];
}
