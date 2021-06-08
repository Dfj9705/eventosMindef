@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="alert alert-info text-center"  role="alert">
            {{$mensaje}}
        </div>
    </div>
    <div class="col-lg-4">
        <a href="{{ route('home')}}" class="btn btn-primary btn-sm btn-block">
            Ir a eventos
        </a>
    </div>
</div>

@endsection
