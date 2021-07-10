<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Mail\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class IndexController extends MainController
{

    public function __construct(ICategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function index(){

        $categoriesList = parent::getCategoriesList();

        if (View::exists('index')){
            return \view('index' , compact('categoriesList'));
        }
        abort(404);
    }

    public function sendNewsletter(Request $request){
        //TODO Make validation
        $email = $request->input('email');

        Mail::to($email)->send(new Newsletter());

        return back();
    }

}
