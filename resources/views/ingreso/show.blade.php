@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">

        <div class="card">
            <div class="card-header">
                <h1>{{ $evento->nombre }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p>Fecha de inicio del evento: {{ date('d/m/Y H:i', strtotime($evento->fecha)) }}</p>
                        <p>Cupo total: {{ $evento->cupo }}</p>
                        <p>Registrados: {{ $registrados }}</p>
                        <p>Ingresados: {{ $total }}</p>
                        <p>Restantes por ingresar: {{ $registrados - $total }}</p>
                        <p>Cupo restante: {{ $evento->cupo - $total }}</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <a class="btn btn-block btn-info" href="{{ route('eventos.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
