<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_institucion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nombre_inst',
        'Direccion',
        'Comuna',
        'ID_Institucion_ayu',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tipo institucion associated with the institucion.
     */
    public function tipoInstitucion()
    {
        return $this->belongsTo(TipoInstitucion::class, 'ID_Institucion_ayu');
    }

    public function Citaciones()
    {
        return $this->belongsTo(Citaciones::class, 'ID_institucion_asociada', 'id');
    }
    
}
