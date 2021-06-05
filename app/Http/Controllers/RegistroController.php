<?php

namespace App\Http\Controllers;

use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RegistroController extends Controller
{
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
        $token = Registro::where('evento','=', $evento )
                        ->where('user' ,'=' , $usuario->id)
                        ->get();

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

        return view('registro.show',compact('token'));
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
