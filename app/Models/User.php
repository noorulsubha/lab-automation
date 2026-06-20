<?php
// ============================================
// USER MODEL
// Location: app/Models/User.php
// Kaam: Users table ke saath kaam karta hai
// ============================================

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // --- Yeh fields fill ho sakte hain ---
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    // --- Password hide rahega ---
    protected $hidden = [
        'password',
    ];
}