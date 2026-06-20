<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * HomeController
 * Handles the Home page and Contact page of the application
 */
class HomeController extends Controller
{
    /**
     * Show the Home page
     * URL: /
     *
     * This method prepares statistics data and sends it to the home view.
     */
    public function index()
    {
        // Static statistics (later can be replaced with database values)
        $stats = [
            'total_tested' => 500,
            'test_types'   => 12,
            'pass_rate'    => 98,
        ];

        // Return the home view with stats data
        return view('home', compact('stats'));
    }

    /**
     * Show the Contact page
     * URL: /contact
     */
    public function contact()
    {
        return view('contact');
    }
}