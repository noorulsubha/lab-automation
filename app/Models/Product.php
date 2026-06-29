<?php
// ============================================
// PRODUCT MODEL
// Location: app/Models/Product.php
// Purpose: Handles all products table operations
// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Fields that can be filled
    protected $fillable = [
        'product_id',
        'name',
        'type',
        'revision',
        'description',
        'image',
    ];

    // One product has many tests
    // Links products table to tests table
    public function tests()
    {
        return $this->hasMany(
            Test::class,
            'product_id',
            'product_id'
        );
    }
}