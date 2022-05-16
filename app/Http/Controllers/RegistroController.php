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
    public function index($id)
    {
        $evento = Evento::find($id);
        $registrados = $evento->registrados;
        return view('registro.index', compact('registrados', 'evento'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imprimir($id)
    {
        $evento = Evento::find($id);
        $registrados = $evento->registrados;
        $pdf = \PDF::loadView('pdf.listado', compact('registrados', 'evento'));
        return $pdf->stream('archivo.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listado($id)
    {
        // $evento = Evento::find($id);
        // $registrados = $evento->registrados;

        $registrados = DB::table('registros') 
                            ->join('users','registros.user_id','users.id')
                            ->select('users.name','users.email','users.dpi', 'users.entidad')
                            ->where('registros.evento_id','=',$id)
                        
                            ->get();

        return json_encode($registrados);

        // return $registrados;
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
        $asistentes = Registro::where('evento_id','=', $evento )
                                ->count();

        $cupoEventos = Evento::select('cupo')
                        ->where('id','=', $evento)
                        ->get();

        foreach ($cupoEventos as $cupoEvento){
            $cupo = $cupoEvento->cupo;
        }


        $token = Registro::where('evento_id','=', $evento )
                        ->where('user_id' ,'=' , $usuario->id)
                        ->get();

        if($asistentes < $cupo){

            if(count($token) > 0){
                foreach ($token as $key) {
                    $token = $key->token;
                }
            }else{
                $token = hash('md5', uniqid($evento));

                auth()->user()->eventosRegistrados()->create([
                    'user_id' => $usuario->id,
                    'evento_id' => $evento,
                    'token' => $token,
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
