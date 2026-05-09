<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Profesor;
use Carbon\Carbon;

class HorarioController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-horario|crear-horario|editar-horario|borrar-horario')->only('index');
        $this->middleware('permission:crear-horario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-horario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-horario', ['only' => ['destroy']]);
    }
    public function index()
    {
        // Obtener la lista de profesores para llenar el menú desplegable en la vista
        $horarios = Horario::all();
        $horario = new Horario();
        $profesores = Profesor::all();
        $profesor = new Profesor();
        $profesorProfesor = Profesor::pluck('nombres', 'id');

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

        return view('horario.index', compact('horarios','horario','profesores', 'profesor','profesorProfesor', 'dias'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'profesor_id' => 'required',
            'turno' => 'required',
            'nivel_educativo' => 'required',
            // No es necesario validar los horarios ahora
        ]);

        // Establecer la zona horaria
        Carbon::now()->setTimezone('America/Lima');

        // Cargar el profesor
        $profesor = Profesor::findOrFail($request->profesor_id);
        $profesor->load('horarios');

        // Arreglo para almacenar los horarios que se guardarán en la base de datos
        $horarios = [];
        // Iterar sobre los horarios de la mañana enviados en la solicitud si existen
        if (isset($request->horarios_mañana)) {
            foreach ($request->horarios_mañana as $horario) {
                // Verificar si el horario está marcado como activo y si la hora de inicio no es nula o vacía
                if (isset($horario['activo']) && $horario['activo'] == 1 && !empty($horario['hora_inicio'])) {
                    // Convertir la hora de inicio y fin a la zona horaria deseada

                    $horarioData = [
                        'dia_semana' => $horario['dia'],
                        'hora_inicio' => $horario['hora_inicio'],
                        'hora_fin' => $horario['hora_fin'],
                        'activo' => 1, // Marcar como activo
                        'turno' => $request->turno, // Asignar el turno correspondiente
                        'nivel_educativo' => $request->nivel_educativo,
                    ];

                    // Agregar el horario al arreglo de horarios
                    $horarios[] = $horarioData;
                }
            }
        }

        // Iterar sobre los horarios de la tarde enviados en la solicitud si existen
        if (isset($request->horarios_tarde)) {
            foreach ($request->horarios_tarde as $horario) {
                // Verificar si el horario está marcado como activo y si la hora de inicio no es nula o vacía
                if (isset($horario['activo']) && $horario['activo'] == 1 && !empty($horario['hora_inicio'])) {


                    // Convertir la hora de inicio y fin a la zona horaria deseada

                    $horarioData = [
                        'dia_semana' => $horario['dia'],
                        'hora_inicio' => $horario['hora_inicio'],
                        'hora_fin' => $horario['hora_fin'],
                        'activo' => 1, // Marcar como activo
                        'turno' => $request->turno, // Asignar el turno correspondiente
                        'nivel_educativo' => $request->nivel_educativo,
                    ];

                    // Agregar el horario al arreglo de horarios
                    $horarios[] = $horarioData;
                }
            }
        }

        // Guardar los horarios en la base de datos asociados al profesor
        $profesor->horarios()->createMany($horarios);

        return redirect()->route('horario.index')->with('create', 'Registro agregado correctamente');
    }
    public function update(Request $request, $id)
    {

        Carbon::now()->setTimezone('America/Lima');
        // Validar los datos recibidos
        $request->validate([
            'profesor_id' => 'required',
            'turno' => 'required',
            'nivel_educativo' => 'required',
            // No es necesario validar los horarios ahora
        ]);
        $horario= Horario::findOrFail($id);
        // Actualizar el detalle de profesor en la base de datos
        $horario->update($request->all());

        return redirect()->route('horario.index')->with('update', 'Registro actualizado correctamente');
    }

    /**
     * Elimina un detalle de profesor de la base de datos.
     */
    public function destroy(Horario $horario)
    {
        // Eliminar el detalle de profesor de la base de datos
        $horario->delete();

        return redirect()->route('horario.index')->with('delete', 'Registro eliminado correctamente');
    }


}

