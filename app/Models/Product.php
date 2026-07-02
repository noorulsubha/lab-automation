<?php
// ============================================
// PRODUCT MODEL
// Location: app/Models/Product.php
// Purpose: Handles all products table operations
// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class Product extends Model
{
    // Table Name (Optional)
    protected $table = 'products';

    // Mass Assignable Fields
    protected $fillable = [
        'product_id',
        'name',
        'type',
        'revision',
        'description',
        'image',
    ];

    // One Product has Many Tests
    public function tests()
    {
        return $this->hasMany(
            Test::class,
            'product_id',
            'product_id'
        );
    }
}