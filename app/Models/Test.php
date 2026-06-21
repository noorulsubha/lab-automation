<?php
// ============================================
// TEST MODEL
// Location: app/Models/Test.php
// Purpose: Handles tests table operations
// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    // Database table name
    protected $table = 'tests';

    // Fields that can be saved
    protected $fillable = [
        'test_id',
        'product_id',
        'test_type',
        'result',
        'remarks',
        'tester_name',
        'test_date',
        'user_id',
        'product_image',
    ];

    // Each test belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ----------------------------------------
    // generateTestId()
    // Purpose: Auto generate 12 digit test ID
    // Example: TSTEL00012024
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

        // Get 2 letter code
        $typeCode = $typeCodes[$testType] ?? 'XX';

        // Get count for roll number
        $count  = self::count() + 1;
        $rollNo = str_pad($count, 4, '0', STR_PAD_LEFT);

        // Build 12 digit test ID
        $testId = 'TST' . $typeCode . $rollNo . date('Y');

        return substr($testId, 0, 12);
    }
}