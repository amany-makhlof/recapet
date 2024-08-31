<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('home');
    }
}
