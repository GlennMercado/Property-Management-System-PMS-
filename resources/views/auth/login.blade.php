@extends('layouts.registerlogin', ['class' => 'bg-light'])

@section('content')
    @include('layouts.headers.guest')
    <div class="container-fluid nvdcbg">
        <div class="container mt--8 pb-5 ">
            <div class="row justify-content-end">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        {{-- <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                            <div class="btn-wrapper text-center">
                                <a href="{{ route('google.login') }}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="{{ asset('nvdcpics') }}/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div> --}}
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Sign in with credentials</small>
                            </div>
                            <form role="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                @if (session('stats'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('stats') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('Error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('Error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}" type="email" name="email"
                                            value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="{{ __('Password') }}" type="password"
                                            value="" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="remember" id="customCheckLogin"
                                        type="checkbox" style={{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheckLogin">
                                        <span class="text-muted">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-primary my-4 bg-success">{{ __('Sign In') }}</button>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                <small>{{ __('Forgot password?') }}</small>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="{{ route('register') }}">
                                            <small>{{ __('Create new account') }}</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('verification.resend-form') }}">
                                        <small>Resend verification link</small>
                                    </a>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .nvdcbg {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("nvdcpics/convention.png");
            background-size: cover;
        }

        .btn {
            border-radius: 10px;
            width: 100%;
            letter-spacing: 2px;
        }

        .bg-secondary {
            margin-top: 80px;
        }

        strong {
            font-size: 30px;
            letter-spacing: 2px;
        }

        small {
            color: #7E898D;
        }
    </style>
@endsection
