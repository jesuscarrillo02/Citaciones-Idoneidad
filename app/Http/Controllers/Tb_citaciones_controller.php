<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citaciones;
use Carbon\Carbon;

class Tb_citaciones_controller extends Controller
{
    public function CitacionesPsi(Request $request)
    {
        $query = Citaciones::query();

        if ($request->has('IDAyudantes_per')) {
            $query->where('ID_institucion_asociada', $request->IDAyudantes_per);
        }

        $citaciones_psi = $query->select('id','ID_Usuario_encargado', 'ID_institucion_asociada', 
        'ID_Ayudante_citado', 'Estado_citacion','Fecha_citacion','Ubicacion_cita')
        ->with(['usuarioEncargado', 'institucionAsociada', 'ayudanteCitado'])
        ->paginate(10);

        return response()->json($citaciones_psi);
    }

    public function CitacionesCrear(Request $request)
    {
        $validatedData = $request->validate([
            'ID_Usuario_encargado' => 'required|exists:users,id',
            'ID_institucion_asociada' => 'required|exists:tb_institucion,id',
            'ID_Ayudante_citado' => 'required|exists:tb_ayudantes,id',
            'Estado_citacion' => 'required|integer',
            'Fecha_citacion' => 'required|date',
            'Ubicacion_cita' => 'required|string|max:255',
        ]);
        
        $citacion = Citaciones::create([
            'Fecha_citacion' => $validatedData['Fecha_citacion'], // '2024-12-24'
            'Ubicacion_cita' => $validatedData['Ubicacion_cita'], // 'Servicio de salud Araucanía Norte'
            'Estado_citacion' => $validatedData['Estado_citacion'], // '0'
            'fecha_de_registro' => Carbon::now()->format('Y-m-d'), // '2024-11-12' (fecha actual)
            'ID_Usuario_encargado' => $validatedData['ID_Usuario_encargado'], // '1'
            'ID_institucion_asociada' => $validatedData['ID_institucion_asociada'], // '1'
            'ID_Ayudante_citado' => $validatedData['ID_Ayudante_citado'], // '24'
        ]);
        dd($citacion);

        return response()->json([
            'message' => 'Citacion registrada exitosamente',
            'citacion' => $citacion,
        ], 200);
    }
}
