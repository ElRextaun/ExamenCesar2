<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;


class AlumnoController extends Controller
{
    public function index()
    {
    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'nombre' => 'required|string',
            'edad' => 'required|string',
            'genero' => 'required',
            'carrera' => 'nullable',
            'etnia_indigena' => 'nullable',
            'becado' => 'nullable',
            'horario' => 'nullable',
            'calificacion_prepa' => 'nullable',
            'estado_salud' => 'nullable',
        ]);
        Alumno::create($data);
        return response([
            'message' => 'Se creo con exito el alumno',
        ], 201);
    }

    public function show($id)
    {
        $alumno = Alumno::where('_id', $id)->first();
        return response($alumno, 200);
    }

    public function update($id, Request $request)
    {
        $data = $this->rules($request);
        Alumno::find($id)->fill($data)->save();
        return response([
            'message' => 'Se modifico con exito el alumno',
        ], 200);

    }

    public function delete($id)
    {
        Alumno::find($id)->delete();
        return response([
            'message' => 'Se elimino con exito el alumno',
        ], 200);
    }

    public function estadisticas(Request $request)
    {
        $total_mascu = Alumno::where("genero", "Masculino")->count();
        $total_feminas = Alumno::where("genero", "Femenina")->count();
        $total_etniaS = Alumno::where("etnia_indigena", "Si")->count();
        $total_etniaN = Alumno::where("etnia_indigena", "No")->count();
        $total_beca = Alumno::where("becado", "Si")->count();
        $total_becano = Alumno::where("becado", "No")->count();
        $total_horarioV = Alumno::where("horario", "Vespertino")->count();
        $total_horarioM = Alumno::where("horario", "Matutino")->count();
        $total_calificacionA = Alumno::where("calificacion_prepa", ">=", "7")->count();
        $total_calificacionR = Alumno::where("calificacion_prepa", "<=", "6")->count();
        $total_saludB = Alumno::where("estado_salud", "Bien")->count();
        $total_saludM = Alumno::where("estado_salud", "Mal")->count();

        return response([
            'total masculinos' => $total_mascu,
            'total femeninas' => $total_feminas,
            'total pertenecientes a una etnia' => $total_etniaS,
            'total no pertenecen a una etnia' => $total_etniaN,
            'total becados' => $total_beca,
            'total no becados' => $total_becano,
            'total vespertino' => $total_horarioV,
            'total matutino' => $total_horarioM,
            'total aprobados' => $total_calificacionA,
            'total reprobados' => $total_calificacionR,
            'total saludables' => $total_saludB,
            'total no saludables' => $total_saludM,
        ]);
    }

    protected function rules($request)
    {
        return $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|string',
            'genero' => 'required',
            'carrera' => 'nullable',
        ]);
    }
}
