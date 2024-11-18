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

    // FUNCION PARA EL REGISTRO AL CARGAR LA IMAGEN
    // public function crear_documento($archivo)
    // {

    //     $data = DB::table('maestropdf')
    //         ->select('archivo')
    //         ->where('archivo', '=', $archivo)
    //         ->get();

    //     $result = json_decode($data, true);

    //     if (count($data) > 0) {
    //         return 0;
    //     } else {
    //         DB::table('maestropdf')->insert([
    //             'archivo' => $archivo,
    //             'ruta_pdf' => "/var/www/html/rep_legal_new/public/storage/images/$archivo.pdf"
    //         ]);
    //         return redirect('home');
    //     }
    // }


    // public function guardarPDF(Request $request)
    // {
    //     // Validar el archivo
    //     $request->validate([
    //         'archivo' => 'required|file|mimes:pdf,jpeg,png',
    //     ]);

    //     // Obtener el archivo y generar un nombre único
    //     $archivo = $request->file('archivo');
    //     $nombre_archivo = uniqid() . '_' . $archivo->getClientOriginalName();

    //     // Asegurarse de que la carpeta 'images' exista
    //     if (!Storage::exists('images')) {
    //         Storage::makeDirectory('images');
    //     }

    //     // Guardar el archivo en el almacenamiento local
    //     $archivo->storeAs('images', $nombre_archivo, 'local');

    //     // Crear el contenido HTML para el PDF (en lugar de usar una vista)
    //     date_default_timezone_set('America/Bogota');
    //     $url = Storage::url('images/' . $nombre_archivo);
    //     $htmlContent = "
    //     <html>
    //         <body>
    //             <h1>Archivo cargado</h1>
    //             <p>El archivo se ha guardado correctamente en el servidor.</p>
    //             <p>URL del archivo: <a href='$url'>$url</a></p>
    //         </body>
    //     </html>
    // ";

    //     // Generar el PDF con el contenido HTML
    //     $pdf = PDF::loadHTML($htmlContent);

    //     // Guardar el PDF en el almacenamiento público
    //     $pdf_content = $pdf->output();
    //     Storage::disk('public')->put($nombre_archivo, $pdf_content);

    //     // Redirigir a la página principal
    //     return redirect('home')->with('success', 'PDF generado y guardado con éxito.');
    // }

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
