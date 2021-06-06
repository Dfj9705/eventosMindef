@extends('layouts.app')
@section('botones')
    {{-- @include('ui.navegacion') --}}
    <div class="row justify-content-end">
        <div class="col-md-2 mb-3 mb-md-0">
            <a href="{{route('home')}}" class="btn btn-dark ">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver al Inicio
            </a>
        </div>
    </div>

@endsection
@section('content')

    <div class="row justify-content-center">
        @if (isset($token))
            <div id="code" data-token='{!! $token !!}'></div>

        @else
            <p>{{$error}}</p>
        @endif
    </div>


@endsection
@section('scripts')
    <script src="/js/app.js"></script>
@endsection
