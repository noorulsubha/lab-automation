<?php
// ============================================
// HOME CONTROLLER
// Location: app/Http/Controllers/HomeController.php
// Purpose: Handles home page and about page
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ----------------------------------------
    // index()
    // URL: GET /
    // Purpose: Show home page
    // ----------------------------------------
    public function index()
    {
        // Stats shown on home page stats bar
        $stats = [
            'total_tested' => 500,
            'test_types'   => 12,
            'pass_rate'    => 98,
        ];

        return view('home', compact('stats'));
    }

    // ----------------------------------------
    // about()
    // URL: GET /about
    // Purpose: Show about page
    // ----------------------------------------
    public function about()
    {
        // Team members data
        $team = [
            [
                'name'  => 'Dr. Ahmad Khan',
                'role'  => 'Lab Director',
                'email' => 'ahmad@srslab.com',
            ],
            [
                'name'  => 'Sara Ali',
                'role'  => 'Senior Technician',
                'email' => 'sara@srslab.com',
            ],
            [
                'name'  => 'Usman Ahmed',
                'role'  => 'Test Engineer',
                'email' => 'usman@srslab.com',
            ],
        ];

        // Achievements data
        $achievements = [
            ['num' => '500+',  'label' => 'Products Tested'],
            ['num' => '12',    'label' => 'Test Types'],
            ['num' => '98%',   'label' => 'Pass Rate'],
            ['num' => '15+',   'label' => 'Years Experience'],
            ['num' => 'CPRI',  'label' => 'Approved Lab'],
            ['num' => '3',     'label' => 'Team Experts'],
        ];

        return view('about', compact('team', 'achievements'));
    }

    // ----------------------------------------
    // contact()
    // URL: GET /contact
    // Purpose: Show contact page
    // ----------------------------------------
    public function contact()
    {
        return view('contact');
    }
}