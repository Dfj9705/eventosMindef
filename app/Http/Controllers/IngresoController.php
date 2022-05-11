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
     *
     * @return \Illuminate\Http\Response
     */
    public function ingreso($token)
    {
        $usuario = Auth::user();

        if($usuario->hasRole('Administrador')){

            $registro = Registro::select('id', 'user_id')->where('token', '=' , $token)->get();
            $id = $registro[0]->id;

            $ingresos = Ingreso::where('registro','=', $id)->get();

            $usuario = User::find($registro[0] -> user_id);

            if(!count($ingresos)>0){
                $ingreso = Ingreso::create([
                    'registro' => $id,
                ]);

                if($ingreso){
                    $mensaje = "Token validado";
                }else{
                    $mensaje = "Token no ingresado";

                }

            }else{
                $mensaje = "Token validado anteriormente";
            }

            return view('ingreso.ingreso', compact('mensaje', 'usuario'));
        }else{
            return view('inicio');
        }
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
