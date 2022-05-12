@extends('layouts.app')
@section('content')
<div class="row justify-content-end mb-3">
   <div class="col-lg-2">
      <a href="{{ route('registro.imprimir', [ 'evento' => $evento->id ]) }}" class="btn btn-info btn-block">Imprimir</a>
   </div>
   <div class="col-lg-2">
      <a href="{{ url()->previous()}}" class="btn btn-secondary btn-block">Volver</a>
   </div>
</div>
<div class="row justify-content-center">
   <div class="col-lg-10">
      <h1>Personas registradas en {{ $evento->nombre }}</h1>
   </div>
</div>
<div class="row justify-content-center">
   <div class="col-lg-10 table-responsive">
      <table class="table table-bordered w-100">
         <thead class="table-dark">
            <tr>
               <th>No.</th>
               <th>Nombre</th>
               <th>DPI</th>
               <th>Correo Electrónico</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($registrados as $key => $registrado)
               <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$registrado->usuario->name}}</td>
                  <td>{{$registrado->usuario->dpi}}</td>
                  <td>{{$registrado->usuario->email}}</td>
      
               </tr>
           
            @endforeach
         </tbody>
      </table>
   </div>
</div>



@endsection