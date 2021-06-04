@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection
@section('content')
{{-- {{$evento}} --}}
    <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
            <img class="rounded " src="/storage/{{ $evento->imagen }}" width="100%" alt="imagen evento">
        </div>
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header lead text-center bg-dark text-white">
                    <h1 class="diplay-1 text-uppercase">{{ $evento->nombre }}</h1>
                </div>
                <div class="card-body">
                    <h2>Fecha del evento</h2>
                    <p class="lead">{{ $evento->fecha }}</p>
                    <h3>Cupo</h3>
                    <p class="lead">{{ $evento->cupo }} personas</p>
                    <h3>Descripción</h3>
                    <p class="text-justify">{{ $evento->descripcion }}</p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary mr-4" href="{{ route('eventos.registro', [ 'evento' => $evento->id ]) }}">Quiero asistir</button>
                    <button class="btn btn-secondary">Ya no quiero asistir</button>
                </div>
            </div>
        </div>
    </div>
@endsection
