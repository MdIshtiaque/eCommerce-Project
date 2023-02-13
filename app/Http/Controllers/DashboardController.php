<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        return view('backend.pages.dashboard');
        //return redirect('admin/login')->with('success', 'You are not allowed to access');

    }
}
