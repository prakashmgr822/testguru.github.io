@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
{{--    <form action="{{ $login_url }}" method="post">--}}
{{--        @csrf--}}
        @if (session('emailError'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('emailError') }}
            </div>
        @endif
        @if (session('passwordError'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('passwordError') }}
            </div>
        @endif
        <div class="mb-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#superadmin" data-toggle="tab">Super Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="#admin" data-toggle="tab">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="#student" data-toggle="tab">Student</a></li>
            </ul>
        </div>
        {{auth()->user()}}

        {{-- Email field --}}
        <div class="tab-content">
            <div class="active tab-pane" id="superadmin">
                <form action="{{ route('superAdmin.login-redirect') }}" method="post">
                    @csrf

                    <input type="hidden" name="login_type" value="superadmin">
                    {{-- Email field --}}
                    <div class="input-group mb-3">
                        <input type="email" name="superAdmin_email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('superAdmin_email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="superAdmin_password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="{{ __('adminlte::adminlte.password') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    {{-- Login field --}}
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                                <input type="checkbox" name="superAdmin_remember" id="remember" {{ old('superAdmin_remember') ? 'checked' : '' }}>

                                <label for="remember">
                                    {{ __('adminlte::adminlte.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-5">
                            <button type=submit
                                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                <span class="fas fa-sign-in-alt"></span>
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                    </div>

                </form>
                @if($password_reset_url)
                    <p class="my-0">
                        <a href="{{ $password_reset_url }}">
                            {{ __('adminlte::adminlte.i_forgot_my_password') }}
                        </a>
                    </p>
                @endif


            </div>
            <div class="tab-pane" id="admin">
                <form action="{{ route('admins.login-redirect') }}" method="post">
                    @csrf

                    <input type="hidden" name="login_type" value="admin">
                    {{-- Email field --}}
                    <div class="input-group mb-3">
                        <input type="email" required name="admin_email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('admin_email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                    </div>

                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" required name="admin_password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="{{ __('adminlte::adminlte.password') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Login field --}}
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                                <input type="checkbox" name="admin_remember"
                                       id="remember" {{ old('admin_remember') ? 'checked' : '' }}>

                                <label for="remember">
                                    {{ __('adminlte::adminlte.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-5">
                            <button type=submit
                                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                <span class="fas fa-sign-in-alt"></span>
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                    </div>

                </form>
                {{-- Password reset link --}}
                @if($password_reset_url)
                    <p class="my-0">
                        <a href="{{ $password_reset_url }}">
                            {{ __('adminlte::adminlte.i_forgot_my_password') }}
                        </a>
                    </p>
                @endif
            </div>
            <div class="tab-pane" id="student">
                <form action="{{ route('user.login-redirect') }}" method="post">
                    @csrf

                    <input type="hidden" name="login_type" value="user">
                    {{-- Email field --}}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="{{ __('adminlte::adminlte.password') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    {{-- Login field --}}
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label for="remember">
                                    {{ __('adminlte::adminlte.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-5">
                            <button type=submit
                                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                <span class="fas fa-sign-in-alt"></span>
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                    </div>

                </form>
                {{-- Password reset link --}}
                @if($password_reset_url)
                    <p class="my-0">
                        <a href="{{ $password_reset_url }}">
                            {{ __('adminlte::adminlte.i_forgot_my_password') }}
                        </a>
                    </p>
                @endif

                {{-- Register link --}}
                <div id="register">
                    @if($register_url)
                        <p class="my-0">
                            <a href="{{ $register_url }}">
                                {{ __('adminlte::adminlte.register_a_new_membership') }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
@stop

@section('auth_footer')

@stop
