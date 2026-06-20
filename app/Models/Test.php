<?php
// ============================================
// TEST MODEL
// Location: app/Models/Test.php
// Purpose: Handles all tests table operations
// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    // Fields that can be filled
    protected $fillable = [
        'test_id',
        'product_id',
        'test_type',
        'result',
        'remarks',
        'tester_name',
        'test_date',
        'user_id',
    ];

    // Each test belongs to one product
    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'product_id'
        );
    }

    // Each test belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ----------------------------------------
    // generateTestId()
    // Purpose: Auto generate 12 digit test ID
    // Example: TSTEL00012024
    // Called when new test record is created
    // ----------------------------------------
    public static function generateTestId($productId, $testType)
    {
        // Short codes for each test type
        $typeCodes = [
            'electrical' => 'EL',
            'load'       => 'LD',
            'thermal'    => 'TH',
            'safety'     => 'SF',
            'mechanical' => 'MC',
        ];

        // Get 2 letter code for test type
        $typeCode = $typeCodes[$testType] ?? 'XX';

        // Get total tests count for roll number
        $count = self::count() + 1;

        // Pad with zeros - example: 0001
        $rollNo = str_pad($count, 4, '0', STR_PAD_LEFT);

        // Build test ID - TST + EL + 0001 + 2024
        $testId = 'TST' . $typeCode . $rollNo . date('Y');

        // Return only 12 characters
        return substr($testId, 0, 12);
    }
}