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
                    <a href="{{ Auth::user()->hasRole('Administrador') ? route('eventos.index') :route('home') }}" class="btn btn-info btn-block">Volver</a>
                </div>
                <div class="card-body">
                    <h2>Fecha del evento</h2>
                    <p class="lead">{{ \Carbon\Carbon::parse($evento->fecha)->diffForHumans() }}  <small>({{ date("d-m-Y H:i", strtotime($evento->fecha)) }})</small></p>
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
                                <p class="text-center lead text-uppercase text-danger font-weight-bold">Este registro es completamente individual</p>
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
                    <p class="text-uppercase text-danger font-weight-bold">Este código es personal e intransferible</p>
                    <small class="text-danger">Válido para una (01) persona</small>
                </div>
                <div class="card-body d-flex justify-content-center">

                    @php
                        foreach($registro as $data){
                            $token = $data['token'];
                        }
                    @endphp

                    <div id="code" data-token='{!! $token !!}'></div>
                </div>
                <div class="card-footer text-center">
                    <button id="imprimir" class="btn btn-info">Imprimir</button>
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
    const buttonImprimir = document.querySelector('#imprimir')
        function asignarCodigo(codigo){
            document.querySelector('#codigo').value = codigo
        }
        function imprimirElemento(elemento) {
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

            var w = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            var h = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var left = ((w / 2) - (w / 2)) + dualScreenLeft;
            var top = ((h / 2) - (h / 2)) + dualScreenTop;
            let ventana = window.open('', 'PRINT', 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            ventana.document.write('<html><head><title>' + document.title + '</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>');
            ventana.document.write("<body class='container text-center'>");
            ventana.document.write("<div class='row justify-content-center mb-3'>");
            ventana.document.write("<div class='col-12'>");
            ventana.document.write('<h1>Tu código para ingresar a {{ $evento->nombre }} </h1>');
            ventana.document.write(" <p class='text-uppercase text-danger font-weight-bold'>Este código es personal e intransferible</p><small class='text-danger '>Válido para una (01) persona</small>");
            ventana.document.write("</div>");
            ventana.document.write("</div>");

            ventana.document.write("<div class='row justify-content-center '>");
            ventana.document.write("<div class='col-6 py-3 border rounded'>");
            ventana.document.write(elemento.innerHTML);
            ventana.document.write("</div>");
            ventana.document.write("</div>");
            @if(count($registro) > 0)
                ventana.document.write("<p class='lead'>Nombre: {{ Auth::user()->name }}</p>");
                ventana.document.write("<p class='lead'>DPI: {{ Auth::user()->dpi }}</p>");
                ventana.document.write("<p class='lead'>Entidad: {{ Auth::user()->entidad }}</p>");
                ventana.document.write("<p class='lead'>Correo electrónico: {{ Auth::user()->email }}</p>");

            @endif
            ventana.document.write('</body>');
            ventana.document.write('</html>');
            ventana.document.close();
            ventana.focus();
        
            setTimeout(() => {
                    ventana.print();
                    ventana.close();
            }, 500);
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

        // alert("hola")
    buttonImprimir.addEventListener('click', ()=>{
        const elemento = document.querySelector('#code')

        imprimirElemento(elemento)
    })
</script>
@endsection
