<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GeneralController extends Controller
{
    public function index()
    {
        if (View::exists('dashboard.pages.general')){
            return \view('dashboard.pages.general');
        }
        abort(404);
    }
}
