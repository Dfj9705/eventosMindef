<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Ingreso;
use App\Registro;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ingreso(Request  $request)
    {
        $usuario = Auth::user();
        $token = $request['token'];
        
        if($usuario->hasRole('Administrador')){

            $registro = Registro::select('id', 'user_id')->where('token', '=' , $token)->get();

            if(count($registro) > 0){
                $id = $registro[0]->id;
    
                $ingresos = Ingreso::where('registro','=', $id)->get();
    
                $usuario = User::find($registro[0] -> user_id);
    
                if(!count($ingresos)>0){
                    $ingreso = Ingreso::create([
                        'registro' => $id,
                    ]);
    
                    if($ingreso){
                        $respuesta = [
                            'mensaje' => "Token validado",
                            'codigo' => 1
                        ];
                       
                    }else{
                        $respuesta = [
                            'mensaje' => "No ingresado",
                            'codigo' => 0
                        ];
    
                    }
    
                }else{
                    $respuesta = [
                        'mensaje' => "Token ingresado anteriormente",
                        'codigo' => 2
                    ];
                }

            }else{
                $respuesta = [
                    'mensaje' => "No encontrado",
                    'codigo' => 0
                ];
            }

        }else{
            
            $respuesta = [
                'mensaje' => "No autorizado",
                'codigo' => 0
            ];
        }
        return response()->json($respuesta);
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        // $registrados =  Registro::where('evento','=', $evento->id )
        //             ->get();

        $total = 0;
        $total = Ingreso::join('registros','ingresos.registro','=','registros.id')
                        ->where('registros.evento_id','=', $evento->id )
                        ->count();
        $registrados = Registro::where('registros.evento_id','=', $evento->id)->count();

        return view('ingreso.show', compact('total','evento','registrados'));
    }


}
