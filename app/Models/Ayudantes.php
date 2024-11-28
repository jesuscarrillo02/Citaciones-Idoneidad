<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayudantes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_ayudantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nombre',
        'Apellido_M',
        'Apellido_P',
        'Edad',
        'RUT_ayu',
        'DV_ayu',
        'Telefono_ayu',
        'Correo_ayu',
        'Estado_ayudante',
        'ID_Institucion_ayu',
        'Fecha_registro',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Fecha_registro' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tipo institucion associated with the institucion.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'ID_Institucion_ayu');
    }

    public function Citaciones()
    {
        return $this->belongsTo(Citaciones::class, 'ID_institucion_asociada', 'id');
    }
}
