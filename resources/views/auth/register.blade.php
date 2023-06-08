@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header lead text-center bg-dark text-white uppercase">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="name" class="">Nombre completo</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                <p class="text-info"> (Debe ingresar un correo válido y existente Ej. usuario@gmail.com, usuario@outlook.es). <span class="font-weight-bold">En este recibirá un correo de confirmación</span></p>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="dpi" class="">NO. de DPI o Pasaporte</label>
                                <input id="dpi" type="dpi" class="form-control @error('dpi') is-invalid @enderror" name="dpi" value="{{ old('dpi') }}"  autocomplete="dpi">

                                @error('dpi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="entidad" class="">Entidad/dependencia a la que pertenece</label>
                                <input id="entidad" type="entidad" class="form-control @error('entidad') is-invalid @enderror" name="entidad" value="{{ old('entidad') }}"  autocomplete="entidad">

                                @error('entidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="password" class="">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <small> (La contraseña debe tener al menos 8 letras mayúsculas, minúsculas, números y carácteres especiales)</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-12">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                                <p class="text-center mt-4">¿Ya tienes una cuenta? <a href="{{route('login')}}">Iniciar Sesión</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
