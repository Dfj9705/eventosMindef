<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $eventos = Evento::where('fecha', '>', date('Y-m-d H:i'))
        ->get();
        // return view('eventos.index',compact('eventos'));
        return view('home',compact('eventos'));
    }
}
