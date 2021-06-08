<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\Registro;
use Illuminate\Http\Request;

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
        $registro = Registro::select('id')->where('token', '=' , $token)->get();
        $id = $registro[0]->id;

        $ingresos = Ingreso::where('registro','=', $id)->get();

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

        return view('ingreso.ingreso', compact('mensaje'));
    }
}
