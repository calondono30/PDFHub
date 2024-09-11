<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
    public function crear_documento($archivo)
    {

        $data = DB::table('dxpst.Rep_Maestropdf')
            ->select('nombre_pdf')
            ->where('nombre_pdf', '=', $archivo)
            ->get();

        $result = json_decode($data, true);

        if (count($data) > 0) {
            return 0;
        } else {
            DB::table('dxpst.Rep_Maestropdf')->insert([
                'nombre_pdf' => $archivo,
                'ruta_pdf' => "/var/www/html/rep_legal_new/public/storage/images/$archivo.pdf"
            ]);
            return 1;
        }
    }

    public function guardarPDF(Request $request)
    {

        $data = $request->all();
        $archivo = $data['archivo'];

        // Obtener el archivo enviado desde el formulario

        $validacion = $this->crear_documento($archivo);

        if ($validacion == 0) {

            session_start();
            $_SESSION['mensaje'] = 1;
            return redirect('/home');
        } else {

            $archivos = $request->file('archivo');

            date_default_timezone_set('america/bogota');

            $imageUrls = [];

            foreach ($archivos as $archivo) {
                $file = uniqid() . '_' . $archivo->getClientOriginalName();
                // Guardar el archivo en el servidor
                $archivo->storeAs('images', $file);
                $url = Storage::url('app/images/') . $file;
                array_push($imageUrls, $url);
            }

            // Generar un nombre único para el archivo  

            $pdf = PDF::loadView('pdf', $data, ['imageUrls' => $imageUrls]);
            // $pdf_content= $pdf->download()->getOriginalContent(); 
            $pdf_content = $pdf->output();

            $nombre_archivo = $archivo . '.pdf';

            Storage::disk('public')->put($nombre_archivo, $pdf_content);



            return redirect('home');
        }
    }
}
