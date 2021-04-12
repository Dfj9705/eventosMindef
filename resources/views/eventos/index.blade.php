@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')


    <div class="row justify-content-center">
        <div class="col-12 text-center ">
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
                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <a class="btn btn-info btn-block">
                                            <i class="fas fa-file-alt fa-xs mr-2"></i>
                                            Ver
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <a class="btn btn-warning btn-block" href="{{ route('eventos.edit', [ 'evento' => $evento->id ]) }}">
                                            <i class="fas fa-edit fa-xs mr-2"></i>
                                            Editar
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirmModal">
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
        function borrarRegistro(){
            $('#confirmModal').modal('hide')


        }
    </script>
@endsection

