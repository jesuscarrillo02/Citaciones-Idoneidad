<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citaciones extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_citaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Fecha_citacion',
        'Estado_citacion',
        'Ubicacion_cita',
        'ID_Usuario_encargado',
        'ID_institucion_asociada',
        'ID_Ayudante_citado',
        'fecha_de_registro'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_de_registro' => 'datetime',
        'Fecha_citacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tipo institucion associated with the institucion.
     */
    public function institucionAsociada()
    {
        return $this->belongsTo(Institucion::class, 'ID_institucion_asociada');
    }

    public function ayudanteCitado()
    {
        return $this->belongsTo(Ayudantes::class, 'ID_Ayudante_citado');
    }

    public function usuarioEncargado()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_encargado');
    }
}
