@extends('layouts.app')

@section('content')
{{-- <div class="container-fluid py-0"> --}}
    {{-- <div class="row justify-content-center mb-3">
        <div class="col-12 text-center">
            <h1>Próximos Eventos</h1>
        </div>
    </div> --}}
    <div class="row justify-content-center mt-lg-0">
        @if (count($eventos) > 0 )
            @foreach ($eventos as $evento)

            <div class="col-md-3 ">
                <div class="card">
                    <img class="card-img-top" style="width: 100%" src="/storage/{{ $evento->imagen }}" alt="Card image cap">

                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($evento->nombre, 20, '...') }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $evento->fecha }}</h6>
                        <p class="card-text">{{ Str::limit($evento->descripcion, 35, '...') }}</p>
                        <a href="{{ route('eventos.show', [ 'evento' => $evento->id ]) }}" class="card-link btn btn-success btn-block">Ver evento</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <p class="lead text-muted">No hay eventos registrados</p>
            </div>
        @endif

    </div>
{{-- </div> --}}
@endsection
