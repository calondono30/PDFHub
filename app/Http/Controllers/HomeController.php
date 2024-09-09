<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //REDIRECCIONAMIENTO A LA PÁGINA PRINCIPAL DE LA PLATAFORMA ACALDERON 03/09/2024
    public function index()
    {
        return view('home');
    }

    //REDIRECCIONAMIENTO A LA PÁGINA DE REPOSITORIOS DE LA PLATAFORMA ACALDERON 03/09/2024
    public function repositorio()
    {
        return view('repositorio');
    }

    //REDIRECCIONAMIENTO A LA PÁGINA CAMBIO DE CONTRASEÑA DE LA PLATAFORMA ACALDERON 03/09/2024
    public function contrasena()
    {
        return view('contrasena');
    }

    //REDIRECCIONAMIENTO A LA PÁGINA DE PERFILES DE LA PLATAFORMA ACALDERON 03/09/2024
    public function perfiles()
    {
        return view('perfiles');
    }    
}
