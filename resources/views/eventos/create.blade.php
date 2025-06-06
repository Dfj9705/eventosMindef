@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header lead text-center bg-dark text-white uppercase">Nuevo evento</div>

            <div class="card-body">
                <form method="POST" action="{{ route('eventos.store')}}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-group row justify-content-center">

                        <div class="col-md-12">
                            <label for="nombre" >Nombre del Evento</label>
                            <input id="nombre" type="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

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
                            <input id="fecha" type="datetime-local" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha" autofocus>

                            @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cupo" >Cupo del Evento</label>
                            <input id="cupo" type="number" class="form-control @error('cupo') is-invalid @enderror" name="cupo" value="{{ old('cupo') }}" required autocomplete="cupo" autofocus>

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
                            <textarea id="descripcion" type="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"  required autocomplete="descripcion" autofocus>{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <label for="imagen">Imagen del evento</label>
                        <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">
                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group row justify-content-center mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
