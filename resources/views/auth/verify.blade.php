@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header lead text-center bg-dark text-white uppercase">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body text-center">
                    <p class="h5">Revisa la bandeja de entrada de: <span class="font-weight-bold text-primary">{{ Auth::user()->email }}</span></p>
                    <p class="font-weight-bold text-primary">Revise que el correo ingresado es correcto y existente</p>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link btn-block p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
