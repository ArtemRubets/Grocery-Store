<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function index(){

        if(View::exists('dashboard.index')){
            return \view('dashboard.index');
        }

        abort(404);
    }
}
