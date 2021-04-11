@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header lead text-center bg-dark text-white uppercase">Nuevo evento</div>

                <div class="card-body">
                    <form method="POST"  novalidate>
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
                            <div class="col-md-6">
                                <label for="fecha" >Fecha del Evento</label>
                                <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha" autofocus>

                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="hora" >Hora del Evento</label>
                                <input id="hora" type="time" class="form-control @error('hora') is-invalid @enderror" name="hora" value="{{ old('hora') }}" required autocomplete="hora" autofocus>

                                @error('hora')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
</div>

@endsection
