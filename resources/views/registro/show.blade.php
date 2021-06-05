@extends('layouts.app')
@section('botones')
    {{-- @include('ui.navegacion') --}}
@endsection
@section('content')

    <div class="row justify-content-center">

      <div id="code" data-token='{!! $token !!}'></div>
    </div>


@endsection
@section('scripts')
    <script src="/js/app.js"></script>
@endsection
