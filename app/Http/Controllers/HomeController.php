<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use App\Models\TipoRuta;

class HomeController extends Controller
{

    public function index(){
        return view('paguinas.rutas');
        }

    public function home()
    {
        $rutas = Ruta::with('imagenes')->get();
        
        // Consultas por departamento/región para las secciones de la Home
        $rutasLaLibertad = Ruta::with('imagenes')->where('tipo', 'La Libertad')->get();
        $rutasAmazonas   = Ruta::with('imagenes')->where('tipo', 'Amazonas')->get();
        $rutasCajamarca  = Ruta::with('imagenes')->where('tipo', 'Cajamarca')->get();
        $rutasHuaraz     = Ruta::with('imagenes')->where('tipo', 'Huaraz')->get();

        return view('paguinas.home', compact(
            'rutas', 
            'rutasLaLibertad', 
            'rutasAmazonas', 
            'rutasCajamarca', 
            'rutasHuaraz'
        ));
    }

    public function rutasPorTipo($tipo)
    {
        // Limpiamos espacios extra o guiones si vienen en la URL
        $tipoFormateado = str_replace('-', ' ', trim($tipo));

        $rutas = Ruta::with('imagenes')
            ->whereRaw('LOWER(tipo) = ?', [strtolower($tipoFormateado)])
            ->get();

        return view('paguinas.rutas', [
            'rutas' => $rutas,
            'tipo'  => $tipoFormateado
        ]);
    }


        public function blog()
        {
            $rutas = Ruta::with('imagenes')->get(); // Relación definida como imagenes()
            return view('paguinas.blog', compact('rutas'));
        }

    public function mostrarDescripcion($id_ruta)
        {
            $ruta = Ruta::with([
                'detalles',
                'lugaresVisitar',
                'serviciosIncluidos',
                'imagenes',
                'fechasDisponibles' => function ($query) {
                    $query->where('fecha', '>=', now())->orderBy('fecha')->limit(6);
                }
            ])->findOrFail($id_ruta);
        
            $rutas = Ruta::with('imagenes')
                ->where('id_ruta', '!=', $id_ruta)
                ->get();
        
            return view('paguinas.descripcionruta', compact('ruta', 'rutas'));
        }
        

}
