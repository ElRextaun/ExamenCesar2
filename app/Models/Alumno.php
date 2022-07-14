<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class Alumno extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'alumnos';
    protected $fillable = [
        'nombre',
        'edad',
        'genero',
        'carrera',
        'etnia_indigena',
        'becado',
        'horario',
        'calificacion_prepa',
        'estado_salud'
    ];
    use HasFactory;
}
