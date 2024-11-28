<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInstitucion extends Model
{
    use HasFactory;

    protected $table = 'tb_tipo_instituciones';

    protected $fillable = ['Tipo_nombre'];

    public function instituciones()
    {
        return $this->hasMany(Institucion::class, 'tipo_Institucion', 'id');
    }
}
