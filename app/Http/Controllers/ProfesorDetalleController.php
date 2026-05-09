<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesordetalle;
use App\Models\Profesor;
use App\Models\Nivel;
use App\Models\Area;
use App\Models\cargo;
use App\Models\estado;
use App\Models\Grado;
use App\Models\Horario;
use App\Models\Seccion;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Math\BrickMathCalculator;

class ProfesorDetalleController extends Controller
{
    function __construct()
    {
        // Definir middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-profesordetalle|crear-profesordetalle|editar-profesordetalle|borrar-profesordetalle')->only('index');
        $this->middleware('permission:crear-profesordetalle', ['only' => ['store']]);
        $this->middleware('permission:editar-profesordetalle', ['only' => ['update']]);
        $this->middleware('permission:borrar-profesordetalle', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todos los detalles de profesor.
     */
    public function index()
    {
        // Obtener todos los detalles de profesor con sus relaciones
        $profesordetalles = Profesordetalle::all();
        $profesordetalle = new Profesordetalle();
        $profesores = Profesor::all();
        $profesor = new Profesor();
        $horarios = Horario::all();
        $horario = new Horario();
        $areaProfesordetalle = area ::pluck('descripcion', 'id');
        $cargoProfesordetalle = cargo ::pluck('descripcion', 'id');
        $profesorProfesordetalle = profesor ::pluck('nombres', 'id');
        $horarioProfesordetalle = Horario::with('profesor')->get()->pluck('profesor.nombres', 'id')->unique();
        //echo"$horarioProfesordetalle";

        // Retornar la vista con los detalles de profesor y otras variables necesarias
        return view('profesordetalle.index', compact('profesordetalles', 'profesordetalle','profesores','profesor','horarios','horario',
        'areaProfesordetalle','cargoProfesordetalle','profesorProfesordetalle', 'horarioProfesordetalle'));
    }


    public function create()
    {
        //
    }
    /**
     * Almacena un nuevo detalle de profesor en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'profesor_id' => 'required|exists:profesor,id',
            'area_id' => 'required|exists:area,id',
            'cargo_id' => 'required|exists:cargo,id',
            'horario_id' => 'required',
        ]);

        // Verificar si Profesor y Horario son iguales
        //if ($request->profesor_id != $request->horario_id) {
            //return redirect()->back()->with('warning', 'El Profesor y el Horario deben ser iguales.');
        //}

        // Crear el detalle de profesor en la base de datos
        Profesordetalle::create($request->all());

        return redirect()->route('profesordetalle.index')->with('create','Registro agregado correctamente');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Actualiza los detalles de un detalle de profesor en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        request()->validate([
            'profesor_id' => 'required|exists:profesor,id',
            'area_id' => 'required|exists:area,id',
            'cargo_id' => 'required|exists:cargo,id',
            'horario_id'=>'required',
        ]);
        $profesordetalle= Profesordetalle::findOrFail($id);
        // Actualizar el detalle de profesor en la base de datos
        $profesordetalle->update($request->all());

        return redirect()->route('profesordetalle.index')->with('update', 'Detalle de profesor actualizado correctamente.');
    }

    /**
     * Elimina un detalle de profesor de la base de datos.
     */
    public function destroy(Profesordetalle $profesordetalle)
    {
        // Eliminar el detalle de profesor de la base de datos
        $profesordetalle->delete();

        return redirect()->route('profesordetalle.index')->with('success', 'Detalle de profesor eliminado correctamente.');
    }
}

