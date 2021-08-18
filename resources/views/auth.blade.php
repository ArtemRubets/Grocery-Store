@extends('layouts.master')

@section('content')
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('home') }}">Home</a><span>|</span>
                </li>
                <li>Sign In & Sign Up</li>
            </ul>
        </div>
    </div>
    <!-- //products-breadcrumb -->
    @include('includes.left-banner')

    <div class="w3l_banner_nav_right">
        <!-- login -->
        <div class="w3_login">
            <h3>Sign In & Sign Up</h3>
            <div class="w3_login_module">
                <div class="module form-module">
                    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                        <div class="tooltip">Click Me</div>
                    </div>
                    <div class="form">
                        <h2>Login to your account</h2>
                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            @error('login')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="text" name="name" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <input type="submit" value="Login">
                        </form>

                        <a href="{{ route('login-with', ['company' => 'google']) }}" class="login-with-btn">
                            <div class="login-with-icon-wrapper">
                                <img class="login-with-icon" src="{{ asset('images/Google__G__Logo.svg') }}"/>
                            </div>
                            <p class="btn-text"><b>Sign in with Google</b></p>
                        </a>
                        <a href="{{ route('login-with', ['company' => 'facebook']) }}" class="login-with-btn facebook">
                            <div class="login-with-icon-wrapper">
                                <img class="login-with-icon" src="{{ asset('images/facebook_icon-icons.com_53612.svg') }}"/>
                            </div>
                            <p class="btn-text"><b>Sign in with Facebook</b></p>
                        </a>

                    </div>
                    <div class="form">
                        <h2>Create an account</h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $message)
                                    <p style="color: red"><small>{{ $message }}</small></p>
                                @endforeach
                            @endif

                            <input type="text" name="name" placeholder="Username" value="{{ old('name') }}">

                            @if($errors->has('password'))
                                @foreach($errors->get('password') as $message)
                                    <p style="color: red"><small>{{ $message }}</small></p>
                                @endforeach
                            @endif
                            <input type="password" name="password" placeholder="Password">

                            <input type="password" name="password_confirmation" placeholder="Repeat password">

                            @if($errors->has('email'))
                                @foreach($errors->get('email') as $message)
                                    <p style="color: red"><small>{{ $message }}</small></p>
                                @endforeach
                            @endif
                            <input type="text" name="email" placeholder="Email Address" value="{{ old('email') }}">

                            @if($errors->has('phone'))
                                @foreach($errors->get('phone') as $message)
                                    <p style="color: red"><small>{{ $message }}</small></p>
                                @endforeach
                            @endif
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                            <input type="submit" value="Register">
                        </form>
                    </div>
                    <div class="cta"><a href="#">Forgot your password?</a></div>
                </div>
            </div>
            <script>
                $('.toggle').click(function(){
                    // Switches the Icon
                    $(this).children('i').toggleClass('fa-pencil');
                    // Switches the forms
                    $('.form').animate({
                        height: "toggle",
                        'padding-top': 'toggle',
                        'padding-bottom': 'toggle',
                        opacity: "toggle"
                    }, "slow");
                });
            </script>
        </div>
        <!-- //login -->
    </div>
    <div class="clearfix"></div>
    </div>
@endsection
