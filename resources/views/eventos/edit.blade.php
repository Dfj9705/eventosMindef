@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header lead text-center bg-dark text-white uppercase">Editar evento</div>

            <div class="card-body">
                <form method="POST" action="{{ route('eventos.update', ['evento' => $evento->id]) }}"  enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group row justify-content-center">

                        <div class="col-md-12">
                            <label for="nombre" >Nombre del Evento</label>
                            <input id="nombre" type="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $evento->nombre }}" required autocomplete="nombre" autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <label for="fecha" >Fecha del Evento</label>
                            <input id="fecha" type="datetime-local" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ date( 'Y-m-d',strtotime($evento->fecha)) . "T" . date( 'H:i',strtotime($evento->fecha)  ) }}" required autocomplete="fecha" autofocus>

                            @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cupo" >Cupo del Evento</label>
                            <input id="cupo" type="number" class="form-control @error('cupo') is-invalid @enderror" name="cupo" value="{{ $evento->cupo  }}" required autocomplete="cupo" autofocus>

                            @error('cupo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">

                        <div class="col-md-12">
                            <label for="descripcion" >Descripción del Evento</label>
                            <textarea id="descripcion" type="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required autocomplete="descripcion" autofocus>{{ $evento->descripcion }}</textarea>

                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <label for="imagen">Imagen del evento</label>
                            <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">

                            @error('imagen')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 text-center">
                            <p>Imagen Actual</p>
                            <img src="/storage/{{ $evento->imagen }}" style="width: 100px">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center  mb-0">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                Guardar cambios
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('eventos.index') }}" class="btn btn-secondary btn-block">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

