<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function barcode()
    {
        return view('barcode');

        $pdf = PDF::loadView('barcode');
            return $pdf->download('Barcode.pdf');
    }
}
