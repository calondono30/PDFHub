<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class HomeController extends Controller
{

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
    public function repositorio(Request $request)
    {
        $data = DB::table('maestropdf')
        ->orderBy('id', 'asc')
        ->get();
        $result = json_decode($data, true);
        return view('repositorio', ['result' => $result]);
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

    public function guardarPDF(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'archivo' => 'required|file|mimes:pdf',
        ]);

        // Obtener el archivo y generar un nombre único
        $archivo = $request->file('archivo');
        $nombre_archivo = uniqid() . '_' . $archivo->getClientOriginalName();

        // Asegurarse de que la carpeta 'pdfs' exista
        if (!Storage::exists('pdfs')) {
            Storage::makeDirectory('pdfs');
        }

        // Guardar el archivo en el almacenamiento local
        $ruta_archivo = $archivo->storeAs('pdfs', $nombre_archivo, 'local');

        // Registrar la información en la base de datos
        $ruta_completa = Storage::path($ruta_archivo); // Obtener la ruta completa
        DB::table('maestropdf')->insert([
            'archivo' => $nombre_archivo,
            'ruta_pdf' => $ruta_completa,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirigir a la página principal con un mensaje de éxito
        return redirect('home')->with('success', 'PDF guardado y registrado con éxito.');
    }
}
