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
      <table id="datatable" class="table table-bordered w-100">
         <thead class="table-dark">
            <tr>
               <th>No.</th>
               <th>Nombre</th>
               <th>Dependencia</th>
               <th>DPI</th>
               <th>Correo Electrónico</th>
            </tr>
         </thead>
         <tbody>
            {{-- @foreach ($registrados as $key => $registrado)
               <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$registrado->usuario->name}}</td>
                  <td>{{$registrado->usuario->entidad}}</td>
                  <td>{{$registrado->usuario->dpi}}</td>
                  <td>{{$registrado->usuario->email}}</td>
      
               </tr>
           
            @endforeach --}}
         </tbody>
      </table>
   </div>
</div>



@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

   const buscarRegistrados = async () =>{
      const url = "{{ route('registro.listado', [ 'evento' => $evento->id ]) }}";
      const config = { method : 'GET'}
      const response = await fetch(url, config);
      const data = await response.json();
      // console.log(data);

      let table = new DataTable('#datatable', {
            data,
            columns: [
               { data: 'name',
                  "render": ( data, type, row, meta ) =>  meta.row + 1 
               },
               { data: 'name' },
               { data: 'entidad'},
               { data: 'dpi'},
               { data: 'email'},
            ],
        });
   }

   buscarRegistrados()
</script>

@endsection