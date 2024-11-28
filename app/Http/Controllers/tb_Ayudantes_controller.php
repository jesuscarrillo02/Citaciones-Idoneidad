<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class tb_Ayudantes_controller extends Controller{

    public function index(Request $request){
        $query = User::query();

        // Filtro de búsqueda
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Paginación
        $ayudantes = $query->select('id', 'name', 'email', 'created_at')->paginate(10);

        return response()->json($ayudantes);
    }
}
