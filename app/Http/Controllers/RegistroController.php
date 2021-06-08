<?php

namespace App\Http\Controllers;

use App\Registro;
use App\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RegistroController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = Auth::user();
        $evento = $request['evento'];
        $asistentes = Registro::where('evento','=', $evento )
                                ->count();

        $cupoEventos = Evento::select('cupo')
                        ->where('id','=', $evento)
                        ->get();

        foreach ($cupoEventos as $cupoEvento){
            $cupo = $cupoEvento->cupo;
        }


        $token = Registro::where('evento','=', $evento )
                        ->where('user' ,'=' , $usuario->id)
                        ->get();

        if($asistentes < $cupo){

            if(count($token) > 0){
                foreach ($token as $key) {
                    $token = $key->token;
                }
            }else{
                $token = hash('md5', uniqid($evento));

                auth()->user()->eventosRegistrados()->create([
                    'user' => $usuario->id,
                    'evento' => $evento,
                    'token' => $token,
                    'user_id' => $usuario->id,
                ]);
            }
            // return view('registro.show',compact('token'));
        }else{
            $error = "El cupo esta lleno";
            // return view('registro.show', compact('error'));
        }

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro)
    {
        return $registro;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro $registro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro $registro)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro $registro)
    {
        $this->authorize('delete', $registro);
        $registro->delete();
        return $registro;
    }
}
