<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EventoController extends Controller
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
        $usuario = Auth::user();
        if($usuario->hasRole('Administrador')){

            $eventos = Evento::where('user_id', $usuario->id )->paginate(10);
            return view('eventos.index',compact('eventos'));
        }else{
            return view('inicio');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = Auth::user();
        if($usuario->hasRole('Administrador')){
            return view('eventos.create');
        }else{
            return view('inicio');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'nombre' => 'required|min:6',
            'descripcion' => 'required',
            'fecha' => 'required|date|after:'.date('Y-m-d H:i'),
            'imagen' => 'required|image',
            'cupo' => 'required|numeric|min:0'

        ]);

        $ruta_imagen = $request['imagen']->store('upload-eventos','public');
            // return public_path("storage/".$ruta_imagen);

        //resize de la img
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(735,1128);
        $img->save();

        auth()->user()->eventos()->create([
            'nombre' => $data['nombre'],
            'fecha' => $data['fecha'],
            'descripcion' => $data['descripcion'],
            'cupo' => $data['cupo'],
            'imagen' => $ruta_imagen,
        ]);

        return redirect()->action('EventoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        $usuario = Auth::user();
        $registro =  Registro::where('evento','=', $evento->id )
                    ->where('user' ,'=' , $usuario->id)
                    ->get();

        $asistentes = Registro::where('evento','=', $evento->id )
                    ->count();
        return view('eventos.show', compact('evento', 'registro','asistentes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        $usuario = Auth::user();
        if($usuario->hasRole('Administrador')){
            $this->authorize('view', $evento);
            return view('eventos.edit',compact('evento'));

        }else{
            return view('inicio');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $usuario = Auth::user();
            if($usuario->hasRole('Administrador')){
                $this->authorize('update', $evento);

            $data = request()->validate([
                'nombre' => 'required|min:6',
                'descripcion' => 'required',
                'fecha' => 'required|date|after:'.date('Y-m-d H:i'),
                'cupo' => 'required|numeric|min:0'

            ]);

            $evento->nombre = $data['nombre'];
            $evento->descripcion = $data['descripcion'];
            $evento->fecha = $data['fecha'];
            $evento->cupo = $data['cupo'];

            if(request('imagen')){
                $ruta_imagen = $request['imagen']->store('upload-eventos','public');

                //resize de la img
                $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(735,1128);
                $img->save();

                $evento->imagen = $ruta_imagen;
            }

            $evento->save();
            return redirect()->action('EventoController@index');
        }else{
            return view('inicio');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        $usuario = Auth::user();
        if($usuario->hasRole('Administrador')){
            $this->authorize('delete', $evento);
        $evento->delete();
        return $evento;
        }else{
            return view('inicio');
        }

        // $evento->delete();
        // return "hola";
    }
}
