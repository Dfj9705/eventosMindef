<?php

namespace App\Http\Controllers;

use App\Evento;
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
        $eventos = Evento::where('user_id', $usuario->id )->paginate(10);
        return view('eventos.index',compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.create');
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
            'cupo' => 'required|numeric'

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        $this->authorize('view', $evento);
        return view('eventos.edit',compact('evento'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
