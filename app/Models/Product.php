<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'price',
        'quantity',
        'status',
        'synced_at',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * TODO: Add fillable property
     * TODO: Add relationship to Category
     * TODO: Add relationship to User
     * TODO: Add relationship to Order
     * TODO: Add relationship to OrderItem
     * TODO: Add relationship to Review
     * TODO: Add relationship to CartItem
     * TODO: Add relationship to WishlistItem
     * TODO: Add relationship to Transaction
     * TODO: Add relationship to TransactionItem
     * TODO: Add relationship to ProductImage
     * TODO: Add relationship to ProductAttribute
     * TODO: Add relationship to ProductAttributeValue
     * TODO: Add relationship to ProductVariation
     */
}
