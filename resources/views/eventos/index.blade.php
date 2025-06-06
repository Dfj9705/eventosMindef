@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')


    <div class="row justify-content-center">
        <div class="col-12 text-center ">
            @if (count($eventos) > 0)
                
            <table class="table table-bordered ">
                <thead class="thead thead-light">
                    <tr>
                        <th >Nombre</th>
                        <th >Fecha</th>
                        <th >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td>
                                {{$evento->nombre}}
                            </td>
                            <td>
                                {{ date( 'd-m-Y H:i ' ,strtotime( $evento->fecha )) }}
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                        <a class="btn btn-info btn-block" href="{{ route('eventos.show', [ 'evento' => $evento->id ]) }}">
                                            <i class="fas fa-file-alt fa-xs mr-2"></i>
                                            Ver
                                        </a>
                                    </div>

                                    <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                        <a class="btn btn-warning btn-block" href="{{ route('eventos.edit', [ 'evento' => $evento->id ]) }}">
                                            <i class="fas fa-edit fa-xs mr-2"></i>
                                            Editar
                                        </a>
                                    </div>

                                    <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                        <a class="btn btn-dark btn-block" href="{{ route('ingreso.estado', [ 'evento' => $evento->id ]) }}">
                                            <i class="fas fa-list fa-xs mr-2"></i>
                                            Estado
                                        </a>
                                    </div>

                                    <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                        <a class="btn btn-primary btn-block" href="{{ route('registro.index', [ 'evento' => $evento->id ]) }}">
                                            <i class="fas fa-list fa-xs mr-2"></i>
                                            Listado
                                        </a>
                                    </div>

                                    <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                        <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirmModal" onclick="asignarCodigo({{ $evento->id }})">
                                            <i class="fas fa-trash fa-xs mr-2"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </div>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>        
            @else
                <p class="lead text-muted">No hay eventos registrados</p>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $eventos->links() }}
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
                        ¿Desea eliminar este registro?
                    </p>
                    <input type="hidden" name="codigo" id="codigo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, conservar</button>
                    <button type="button" class="btn btn-danger" onclick="borrarRegistro()">Si, Eliminar</button>
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
            axios.post(`/eventos/${codigo}`, params)
            .then(response => {
                // console.log(response);
                if(response.status == 200 ){
                    location.reload();
                }
            })

        }
    </script>
@endsection

