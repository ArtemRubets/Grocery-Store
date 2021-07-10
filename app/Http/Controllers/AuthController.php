<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthController extends MainController
{
    public function __construct(ICategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function register(RegisterFormRequest $request)
    {
        if (Auth::check()){
            return back()->withErrors(['regError' => "You already register"]);
        }

        $validated = $request->validated();

        if ($validated){
            Auth::login(User::create($validated));

            $role = Role::where('role' , 'guest')->first();
            $user = Auth::user();

            $user->roles()->attach($role);

            session(['user_name' => $user->name]);
            session(['user_role' => Auth::user()->roles()->first()->role]);

            return redirect()->route('dashboard.home');
        }

        return back()->withInput()->withErrors(['regError' => 'Register Error!']);

    }

    public function login(Request $request)
    {
        if (Auth::check()){
            return back()->withErrors(['login' => "You already authorize"]);
        }

        $data = $request->except(['_token']);

        if (Auth::attempt($data)){
            session(['user_name' => Auth::user()->name]);
            session(['user_role' => Auth::user()->roles()->first()->role]);
            return redirect()->intended(route('dashboard.home'));
        }

        return back()->withErrors(['login' => "Not correct login or password"]);
    }

    public function logout()
    {
        if (Auth::check()){
            Auth::logout();
            session()->forget('user_name');
            session()->forget('user_role');
        }
        return redirect()->route('home');
    }

    public function index()
    {
        if (Auth::check()){
            return redirect()->route('home');
        }

        $categoriesList = parent::getCategoriesList();

        if (View::exists('auth')){
            return \view('auth' , compact('categoriesList'));
        }
        abort(404);
    }
}
