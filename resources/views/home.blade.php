@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Próximos Eventos</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($eventos as $evento)

        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="/storage/{{ $evento->imagen }}" alt="Card image cap">

                <div class="card-body">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $evento->fecha }}</h6>
                    <p class="card-text">{{ Str::limit($evento->descripcion, 35, '...') }}</p>
                    <a href="{{ route('eventos.show', [ 'evento' => $evento->id ]) }}" class="card-link">Ver evento</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
