<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\GlobalFunctions;
use App\Http\MainFunctions;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainFunctions = new MainFunctions("facebook", "44", "alfhh hinojosa");
        $mainFunctions->register();
        $mainFunctions = new MainFunctions("slack", "45", "alfhh hinojosa");
        $mainFunctions->register();
        $mainFunctions = new MainFunctions("facebook", "44", "Spanishs");
        $mainFunctions->addLanguage();
        return 'done';
    }
}
