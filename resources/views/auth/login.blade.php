@extends('layouts.login')

@section('content')

<div class="container-fluid">
    <div class="row" style="padding-bottom: 3%;padding-top: 5%">
        <div class="col-md-8 col-md-offset-4">
            <img src="images/Logo.png" width="40%" class="img-responsive">
        </div>
    </div>
    <div class="row row-center" style="background-color: #4a4a4a;">
        <div class="col-md-6">

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-center" style="color:white;padding-bottom: 2%">Bienvenido a Wuash</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-center" style="color:white;padding-bottom: 3%">Ingresa al sistema con tu usuario y contraseña</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label" style="color:white;">Usuario</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label" style="color:white;">Clave</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-center">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-warning">
                                Login
                            </button>
                        </div>
                    </div>
                    <div class="row row-center">
                        <div class="col-lg-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span style="color:white">Remember Me</span>
                                </label>
                            </div>  
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color:white">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
    @endsection
