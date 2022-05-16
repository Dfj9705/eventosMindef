<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Personas</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <style>
            *{margin:0;padding:0}
            .header,
            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
            }
            .header {
                top: 0px;
            }
            .footer {
                bottom: 0px;
            }
            .pagenum:before {
                content: counter(page);
            }
        </style>
    </head>
    <body>
        <header class="container text-center">
            <div class="row justify-content-center">
                <div class="col-12">
                    <p class="lead text-muted">Ministerio de la Defensa Nacional</p>
                </div>
              
            </div>
        </header>
        <div class="container text-center">

            <div class="row">
                <div class="col-12">
                    <h4>Personas registradas en {{ $evento->nombre }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm table-bordered w-100">
                        <thead class="thead">
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Entidad</th>
                            <th>DPI</th>
                            <th>Correo Electrónico</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($registrados as $key => $registrado)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$registrado->usuario->name}}</td>
                                <td>{{$registrado->usuario->entidad}}</td>
                                <td>{{$registrado->usuario->dpi}}</td>
                                <td>{{$registrado->usuario->email}}</td>
                    
                            </tr>
                        
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer">
            <p class="text-muted">Página <span class="pagenum"></span></p>
        </div>
    </body>
</html>