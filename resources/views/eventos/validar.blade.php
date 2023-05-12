@extends('layouts.app')

@section('content')
    <h1 class="text-center">Validación</h1>
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div id="reader" class="w-100"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('/js/scanner.js') }}"></script>
@endsection