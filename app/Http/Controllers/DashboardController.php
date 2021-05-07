<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //return dashboard view
    public function dashboard(){
        return view('dashboard.accountdashboard');
    }

    public function registerCaretaker(){
        return view('auth.caretakerRegister');
    }
}
