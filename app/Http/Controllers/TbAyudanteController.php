<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayudantes;

class TbAyudanteController extends Controller
{
    public function MostraraPsi(Request $request)
    {
        // Crear una consulta base con el modelo Institucion
        $query = Ayudantes::query();

        // Filtro de búsqueda: Si se pasa el parámetro 'search', filtra por 'Nombre_inst'
        if ($request->has('search') && $request->search !== '') {
            $query->where('Nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('institutionId')) {
            $query->where('ID_Institucion_ayu', $request->institutionId);
        }

        // Seleccionar los campos necesarios
        $ayudantes_psi = $query->select('id','Nombre', 'Apellido_M', 'Apellido_P', 'Edad','RUT_ayu','DV_ayu','Correo_ayu','Telefono_ayu','Estado_ayudante','ID_Institucion_ayu')
        ->with(['institucion'])
        ->paginate(5);

        // Retornar los resultados como una respuesta JSON
        return response()->json($ayudantes_psi);
    }

    public function MostrarEdu(Request $request)
    {
        // Crear una consulta base con el modelo Institucion
        $query = Ayudantes::query();

        // Filtro de búsqueda: Si se pasa el parámetro 'search', filtra por 'Nombre_inst'
        if ($request->has('search') && $request->search !== '') {
            $query->where('Nombre', 'like', '%' . $request->search . '%');
        }

        
        if ($request->has('IDInstitucion')) {
            $query->where('ID_Institucion_ayu', $request->IDInstitucion);
        }
        
        // Seleccionar los campos necesarios
        $ayudantes_edu = $query->select('id','Nombre', 'Apellido_M', 'Apellido_P', 'Edad','RUT_ayu','DV_ayu','Correo_ayu','Telefono_ayu','Estado_ayudante','Fecha_registro','ID_Institucion_ayu')->paginate(10);

        // Retornar los resultados como una respuesta JSON
        return response()->json($ayudantes_edu);
    }

    public function crearAyudante(Request $request){
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellido_M' => 'required|string|max:255',
            'Apellido_P' => 'required|string|max:255',
            'Edad' => 'required|integer',
            'RUT_ayu' => 'required|integer',
            'DV_ayu' => 'required|integer',
            'Telefono_ayu' => 'required|integer',
            'Correo_ayu' => 'required|string|max:255',
            'Estado_ayudante' => 'required|boolean',
            'ID_Institucion_ayu' => 'required|exists:tb_institucion,id'
        ]);
        
        // Crear el nuevo registro en la base de datos
        $xd = Ayudantes::create([
            'Nombre' => $request->Nombre,
            'Apellido_M' => $request->Apellido_M,
            'Apellido_P' => $request->Apellido_P,
            'Edad' => $request->Edad,
            'RUT_ayu' => $request->RUT_ayu,
            'DV_ayu' => $request->DV_ayu,
            'Telefono_ayu' => $request->Telefono_ayu,
            'Correo_ayu' => $request->Correo_ayu,
            'Estado_ayudante' => (int)$request->Estado_ayudante, // Convertir a entero
            'ID_Institucion_ayu' => $request->ID_Institucion_ayu,
            'Fecha_registro' => now()->format('Y-m-d\TH:i:s.u\Z'), // Formato de fecha actual
        ]);
        dd($xd);
        return response()->json(['message' => 'Ayudante registrado exitosamente']);
    }
}
