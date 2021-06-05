@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection
@section('content')
{{-- {{$registro}} --}}
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
                    @if (count($registro) > 0)



                            <button class="btn btn-danger">Ya no quiero asistir</button>


                    @else
                    <form action="{{ route('eventos.registro', [ 'evento' => $evento->id ]) }} " method="post">
                        @csrf
                        <input type="hidden" name="evento" value="{{$evento ->id }}">
                        <button submit class="btn btn-primary btn-block mr-4" >Quiero asistir</button>
                    </form>

                    @endif

                </div>
            </div>
            @if (count($registro) > 0)
            <div class="card">
                <div class="card-header lead text-center ">
                    <p class="lead text-uppercase">Tu Código de acceso</p>
                </div>
                <div class="card-body d-flex justify-content-center">

                    @php
                        foreach($registro as $data){
                            $token = $data['token'];
                        }
                    @endphp

                    <div id="code" data-token='{!! $token !!}'></div>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection
@section('scripts')
{{-- <script src="/js/app.js"></script> --}}
@endsection
