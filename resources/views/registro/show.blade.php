@extends('layouts.app')
@section('botones')
    {{-- @include('ui.navegacion') --}}
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
