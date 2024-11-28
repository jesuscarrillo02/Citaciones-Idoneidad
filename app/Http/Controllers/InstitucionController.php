<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index(Request $request)
    {
        // Crear una consulta base con el modelo Institucion
        $query = Institucion::query();

        // Filtro de búsqueda: Si se pasa el parámetro 'search', filtra por 'Nombre_inst'
        if ($request->has('search') && $request->search !== '') {
            $query->where('Nombre_inst', 'like', '%' . $request->search . '%');
        }

        // Filtro adicional: Solo instituciones con tipo_Institucion igual a 2
        $query->where('ID_Institucion_ayu', 2);

        // Seleccionar los campos necesarios
        $instituciones = $query->select('id','Nombre_inst', 'Direccion', 'Comuna', 'ID_Institucion_ayu')->get();

        // Retornar los resultados como una respuesta JSON
        return response()->json($instituciones);
    }


    public function listadoInsti(Request $request)
    {
        // Crear una consulta base con el modelo Institucion
        $query = Institucion::query();

        if ($request->has('tipo')) {
            $query->where('ID_Institucion_ayu', $request->tipo);
        }
        $instituciones = $query->select('id','Nombre_inst', 'Direccion', 'Comuna', 'ID_Institucion_ayu')->get();

        // Retornar los resultados como una respuesta JSON
        return response()->json($instituciones);
    }

    public function listadoInstiActial(Request $request)
    {
        // Crear una consulta base con el modelo Institucion
        $query = Institucion::query();

        if ($request->has('institutionId')) {
            $query->where('id', $request->institutionId);
        }
        $instituciones = $query->select('id','Nombre_inst')->first();

        // Retornar los resultados como una respuesta JSON
        return response()->json($instituciones);
    }
    
}
