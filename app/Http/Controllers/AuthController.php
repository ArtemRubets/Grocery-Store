<?php

namespace App\Http\Controllers;

use App\Auth\AbstractAuthFactory;
use App\Auth\SocialiteFactory;
use App\Http\Requests\RegisterFormRequest;
use App\Interfaces\IUserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthController extends MainController
{

    private $userRepository;

    protected $authFactory;

    public function __construct(IUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->authFactory = new AbstractAuthFactory();
    }

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

    public function login(Request $request, $company = null, $redirect = null)
    {
        if (Auth::check()) {
            return back()->withErrors(['login' => "You are already authorized"]);
        }

        if ($request->isMethod('POST')){
            $data = $request->except(['_token']);

            $basicFactory = $this->authFactory->basicFactory();
            $response = $basicFactory->build()->login($data);

            if ($response instanceof RedirectResponse) return $response;

        }else{
            if ($company && $redirect){
                $socialiteFactory = $this->authFactory->socialiteFactory();
                $socialiteFactory->build($company)->login($this->userRepository);

            }else{
                $socialiteFactory = $this->authFactory->socialiteFactory();

                return $socialiteFactory->build($company)->loginRequest();
            }
        }

        session(['user_name' => Auth::user()->name]);
        session(['user_role' => Auth::user()->roles->first()->role]);

        return redirect()->intended(route('dashboard.home'));

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
}
