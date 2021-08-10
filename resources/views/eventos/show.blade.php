@extends('layouts.app')
@section('botones')
@can('create_eventos')
    @include('ui.navegacion')

@endcan
@endsection
@section('content')
{{-- {{$registro}} --}}
@php
    foreach($registro as $data){
        $token = $data['token'];
        $registroId = $data['id'];
    }
@endphp
{{-- {{$evento}} --}}
    <div class="row justify-content-center">

        <div class="col-md-3 mb-3 mb-md-0 ">
            <img class="rounded" src="/storage/{{ $evento->imagen }}" width="100%" alt="imagen evento">
        </div>
        <div class="col-md-7">
            <div class="card ">
                <div class="card-header lead text-center ">
                    <h1 class="diplay-1 text-uppercase">{{ $evento->nombre }}</h1>
                </div>
                <div class="card-body">
                    <h2>Fecha del evento</h2>
                    <p class="lead">{{ date('d-m-Y H:i:s', strtotime($evento->fecha))  }}</p>
                    <h3>Cupo</h3>
                    @php
                        $cupoTotal = $evento->cupo - $asistentes
                    @endphp

                    @if ($cupoTotal > 0 )
                        <p class="lead">{{ $cupoTotal }} personas </p>

                    @else
                        <p class="lead">No hay cupo </p>

                    @endif
                    <h3>Descripción</h3>
                    <p class="text-justify">{{ $evento->descripcion }}</p>
                </div>
                @if( $evento->fecha >= Carbon\Carbon::now() )
                <div class="card-footer d-flex justify-content-end">
                    @if (count($registro) > 0)

                    <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirmModal" onclick="asignarCodigo({{ $registroId }})">

                        Ya no asistir
                    </a>


                    @else
                        @if ($cupoTotal > 0)
                        <div class="col-12">
                            <form action="{{ route('eventos.registro', [ 'evento' => $evento->id ]) }} " method="post">
                                @csrf
                                <input type="hidden" name="evento" value="{{$evento ->id }}">
                                <button submit class="btn btn-primary btn-block mr-4" >Quiero asistir</button>
                            </form>

                        </div>

                        @else
                            <p class="text-muted">Ya no hay cupo</p>

                        @endif

                    @endif
                    
                </div>
                @endif
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
@section('modal')
    <div class="modal fade modal-xs" id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmación de borrado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        ¿Esta seguro que ya no desea asistir a este evento?
                    </p>
                    <input type="hidden" name="codigo" id="codigo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, quiero asistir</button>
                    <button type="button" class="btn btn-secondary" onclick="borrarRegistro()">Si</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
        function asignarCodigo(codigo){
            document.querySelector('#codigo').value = codigo
        }

        function borrarRegistro(){
            let codigo = document.querySelector('#codigo').value
            $('#confirmModal').modal('hide')
            const params = {
                _method : 'delete'
            }
            axios.post(`/registro/${codigo}`, params)
            .then(response => {
                // console.log(response)
                if(response.status == 200 ){
                    location.reload();
                }
            })

        }

</script>
@endsection
