<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends MainController
{

    public function register(RegisterFormRequest $request)
    {
        if (Auth::check()) {
            return back()->withErrors(['regError' => "You already register"]);
        }

        $validated = $request->validated();

        if ($validated) {
            Auth::login(User::create($validated));

            $role = Role::where('role', 'guest')->first();
            $user = Auth::user();

            $user->roles()->attach($role);

            session(['user_name' => $user->name]);
            session(['user_role' => $user->roles->first()->role]);

            return redirect()->route('dashboard.home');
        }

        return back()->withInput()->withErrors(['regError' => 'Register Error!']);

    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return back()->withErrors(['login' => "You already authorize"]);
        }

        $data = $request->except(['_token']);

        if (Auth::attempt($data)) {
            $user = Auth::user();

            session(['user_name' => $user->name]);
            session(['user_role' => $user->roles->first()->role]);

            return redirect()->intended(route('dashboard.home'));
        }

        return back()->withErrors(['login' => "Not correct login or password"]);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            session()->forget('user_name');
            session()->forget('user_role');
        }
        return redirect()->route('home');
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        if (View::exists('auth')) {
            return \view('auth');
        }
        abort(404);
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if ($googleUser) {

                $user = User::whereEmail($googleUser->getEmail())->first();

                if (!$user) {
                    User::create([
                        'email' => $googleUser->getEmail(),
                        'name' => $googleUser->user['given_name'],
                        'password' => \Hash::make(\Str::random()),
                        //TODO phone is not required. Fix
                        'phone' => '+380372888849'
                    ]);

                    $role = Role::where('role', 'guest')->first();
                    $user->roles()->attach($role);
                }

                Auth::login($user);

                session(['user_name' => $user->name]);
                session(['user_role' => $user->roles->first()->role]);
            }
            return redirect()->intended(route('dashboard.home'));

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

}
