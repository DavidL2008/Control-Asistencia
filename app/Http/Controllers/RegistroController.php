<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Horario;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Math\BrickMathCalculator;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use Carbon\CarbonInterface;

class RegistroController extends Controller
{
    function __construct()
    {
        // Middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-registro|crear-registro|editar-registro|borrar-registro')->only('index');
        $this->middleware('permission:crear-registro', ['only' => ['store']]);
        $this->middleware('permission:editar-registro', ['only' => ['update', 'edit']]);
        $this->middleware('permission:borrar-registro', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todos los registros.
     */
    public function index()
    {
        // Obtener todos los registros con la información del profesor relacionado
        date_default_timezone_set('America/Lima');


        $registros = Registro::with('profesor')
                         ->where('fecha_registro', '>=', Carbon::now()->startOfWeek())
                         ->where('fecha_registro', '<=', Carbon::now()->endOfWeek())
                         ->orderByDesc('id')
                         ->get();

        return view('registro.index', compact('registros'));
    }
    /**
     * Muestra el formulario para crear un nuevo registro.
     */
    public function create()
    {
        // Obtener todos los profesores para el formulario de creación
        $profesores = Profesor::all();
        return view('registro.create', compact('profesores'));
    }
    public function mostrar()
    {
        return view('lector.index');
    }

    /**
     * Almacena un nuevo registro en la base de datos.
     */


     public function store(Request $request)
    {
        // Verificar si se envió un dato QR
        if ($request->has('qrData')) {
            // Procesar el registro mediante QR como lo hace actualmente
            Log::info('Datos recibidos', $request->all());
            $request->validate([
                'qrData' => 'required'
            ]);
            date_default_timezone_set('America/Lima');
            $profesor = Profesor::where('DNI', $request->input('qrData'))->first();
            // Verificar si el profesor existe
            if ($profesor) {
                // Obtener todos los horarios del profesor para el día actual
                Carbon::setLocale('es');
                $horarios = Horario::where('profesor_id', $profesor->id)->where('dia_semana', ucfirst(Carbon::now()->setTimezone('America/Lima')->isoFormat('dddd')))->get();
                // Verificar si hay horarios registrados para el profesor en el día actual
                if ($horarios->isNotEmpty()) {

                    // Iterar sobre cada horario del profesor para el día actual
                    foreach ($horarios as $horario) {


                        // Obtener la hora de inicio y fin del horario
                        $hora_inicio = Carbon::parse($horario->hora_inicio)->copy()->setTimezone('America/Lima');
                        $hora_fin = Carbon::parse($horario->hora_fin)->copy()->setTimezone('America/Lima');
                        $hora_registro_hms = Carbon::now()->setTimezone('America/Lima');


                        $diferencia_minutos_inicio = round(($hora_registro_hms->timestamp - $hora_inicio->timestamp) / 60);

                        // Calcular la diferencia en minutos entre la hora de registro y la hora de fin
                        $diferencia_minutos_fin = round(($hora_registro_hms->timestamp - $hora_fin->timestamp) / 60);

                        // Verificar si la hora de registro está dentro del horario asignado
                        if ($hora_registro_hms >= $hora_inicio->subMinutes(30) && $hora_registro_hms <= $hora_fin->addMinutes(15)){

                            if (($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) ||
                            ($diferencia_minutos_fin >= -30 && $diferencia_minutos_fin <= 15)) {

                            // Determinar el tipo de registro (entrada o salida) y la asistencia
                            if ($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) {
                                // Es un registro de entrada
                                $estado = "Entrada";
                            } else {
                                // Es un registro de salida
                                $estado = "Salida";
                            }

                            if ($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) {
                                // Aplica las funciones existentes para determinar el estado de asistencia
                                if ($diferencia_minutos_inicio > -30 && $diferencia_minutos_inicio < 0) {
                                    // Si está dentro del rango de hasta 20 minutos antes de la hora de inicio
                                    $asistencia = 'Adelanto';
                                }
                                if ($diferencia_minutos_inicio >= 0 && $diferencia_minutos_inicio <= 10) {
                                    // Si está dentro del rango de 10 minutos después de la hora de inicio
                                    $asistencia = 'Puntual';
                                }
                                if ($diferencia_minutos_inicio > 10 && $diferencia_minutos_inicio <= 20) {
                                    // Si está dentro del rango de 10 a 20 minutos después de la hora de inicio
                                    $asistencia = 'Tardanza';
                                }
                                if ($diferencia_minutos_inicio > 20 && $diferencia_minutos_inicio <= 30) {
                                    // Si está dentro del rango de 10 a 20 minutos después de la hora de inicio
                                    $asistencia = 'Falta';
                                }
                            } elseif ($diferencia_minutos_fin >= -30 && $diferencia_minutos_fin <= 15) {
                                // Aplica las funciones existentes para determinar el estado de asistencia
                                if ($diferencia_minutos_fin > -30 && $diferencia_minutos_fin < 0) {
                                    // Si está dentro del rango de hasta 20 minutos antes de la hora de inicio
                                    $asistencia = 'Adelanto';
                                }
                                if ($diferencia_minutos_fin >= 0 && $diferencia_minutos_fin <= 15) {
                                    // Si está dentro del rango de 10 minutos después de la hora de inicio
                                    $asistencia = 'Puntual';

                                }
                            }

                            // Crear el registro asociado al profesor
                            $registro = new Registro();
                            $registro->profesor_id = $profesor->id;
                            $registro->horario_id = $horario->id; // Asociar el horario al registro

                            // Obtener solo la fecha y la hora necesarias
                            $fecha_registro = Carbon::now()->setTimezone('America/Lima')->toDateString();
                            $hora_registro = Carbon::now()->setTimezone('America/Lima')->format('H:i:s');

                            $registro->fecha_registro = $fecha_registro; // Asignar la fecha actual
                            $registro->hora_registro = $hora_registro; // Asignar la hora actual
                            $registro->estado = $estado;
                            $registro->asistencia = $asistencia;

                            $registro->save();



                        }
                            //return redirect()->route('registro.index')->with('create', 'Registro agregado correctamente');
                            return response()->json(['success' => true, 'message' => 'Registro agregado correctamente']);

                        }
                    }
                    return response()->json(['success' => false, 'message' => 'Registro agregado correctamente']);
                } else {
                    // Mostrar mensaje de error si no hay horarios registrados para el profesor en el día actual
                    return response()->json(['success' => false, 'message' => 'Registro agregado correctamente']);
                }

            } else {
                // Mostrar mensaje de error si el profesor no existe
                return response()->json(['success' => false, 'message' => 'Registro agregado correctamente']);
            }

        } else {
            // Procesar el registro desde el formulario
            $request->validate([
                'DNI' => 'required|max:8'
            ]);

            date_default_timezone_set('America/Lima');

            $profesor = Profesor::where('DNI', $request->input('DNI'))->first();

            // Verificar si el profesor existe
            if ($profesor) {
                // Obtener todos los horarios del profesor para el día actual
                Carbon::setLocale('es');
                $horarios = Horario::where('profesor_id', $profesor->id)->where('dia_semana', ucfirst(Carbon::now()->setTimezone('America/Lima')->isoFormat('dddd')))->get();
                // Verificar si hay horarios registrados para el profesor en el día actual
                if ($horarios->isNotEmpty()) {

                    // Iterar sobre cada horario del profesor para el día actual
                    foreach ($horarios as $horario) {


                        // Obtener la hora de inicio y fin del horario
                        $hora_inicio = Carbon::parse($horario->hora_inicio)->copy()->setTimezone('America/Lima');
                        $hora_fin = Carbon::parse($horario->hora_fin)->copy()->setTimezone('America/Lima');
                        $hora_registro_hms = Carbon::now()->setTimezone('America/Lima');


                        $diferencia_minutos_inicio = round(($hora_registro_hms->timestamp - $hora_inicio->timestamp) / 60);

                        // Calcular la diferencia en minutos entre la hora de registro y la hora de fin
                        $diferencia_minutos_fin = round(($hora_registro_hms->timestamp - $hora_fin->timestamp) / 60);

                        // Verificar si la hora de registro está dentro del horario asignado
                        if ($hora_registro_hms >= $hora_inicio->subMinutes(30) && $hora_registro_hms <= $hora_fin->addMinutes(15)){

                            if (($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) ||
                            ($diferencia_minutos_fin >= -30 && $diferencia_minutos_fin <= 15)) {

                                // Determinar el tipo de registro (entrada o salida) y la asistencia
                                if ($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) {
                                    // Es un registro de entrada
                                    $estado = "Entrada";
                                } else {
                                    // Es un registro de salida
                                    $estado = "Salida";
                                }

                                if ($diferencia_minutos_inicio >= -30 && $diferencia_minutos_inicio <= 30) {
                                    // Aplica las funciones existentes para determinar el estado de asistencia
                                    if ($diferencia_minutos_inicio > -30 && $diferencia_minutos_inicio < 0) {
                                        // Si está dentro del rango de hasta 20 minutos antes de la hora de inicio
                                        $asistencia = 'Adelanto';
                                    }
                                    if ($diferencia_minutos_inicio >= 0 && $diferencia_minutos_inicio <= 10) {
                                        // Si está dentro del rango de 10 minutos después de la hora de inicio
                                        $asistencia = 'Puntual';
                                    }
                                    if ($diferencia_minutos_inicio > 10 && $diferencia_minutos_inicio <= 20) {
                                        // Si está dentro del rango de 10 a 20 minutos después de la hora de inicio
                                        $asistencia = 'Tardanza';
                                    }
                                    if ($diferencia_minutos_inicio > 20 && $diferencia_minutos_inicio <= 30) {
                                        // Si está dentro del rango de 10 a 20 minutos después de la hora de inicio
                                        $asistencia = 'Falta';
                                    }
                                } elseif ($diferencia_minutos_fin >= -30 && $diferencia_minutos_fin <= 15) {
                                    // Aplica las funciones existentes para determinar el estado de asistencia
                                    if ($diferencia_minutos_fin > -30 && $diferencia_minutos_fin < 0) {
                                        // Si está dentro del rango de hasta 20 minutos antes de la hora de inicio
                                        $asistencia = 'Adelanto';
                                    }
                                    if ($diferencia_minutos_fin >= 0 && $diferencia_minutos_fin <= 15) {
                                        // Si está dentro del rango de 10 minutos después de la hora de inicio
                                        $asistencia = 'Puntual';

                                    }
                                }

                                // Crear el registro asociado al profesor
                                $registro = new Registro();
                                $registro->profesor_id = $profesor->id;
                                $registro->horario_id = $horario->id; // Asociar el horario al registro

                                // Obtener solo la fecha y la hora necesarias
                                $fecha_registro = Carbon::now()->setTimezone('America/Lima')->toDateString();
                                $hora_registro = Carbon::now()->setTimezone('America/Lima')->format('H:i:s');

                                $registro->fecha_registro = $fecha_registro; // Asignar la fecha actual
                                $registro->hora_registro = $hora_registro; // Asignar la hora actual
                                $registro->estado = $estado;
                                $registro->asistencia = $asistencia;

                                $registro->save();

                            }
                            return redirect()->route('registro.index')->with('create', 'Registro agregado correctamente');
                            //return response()->json(['success' => true, 'message' => 'Registro agregado correctamente']);

                        }
                    }
                    return redirect()->route('registro.index')->with('error', 'Registro en horas no asignadas');
                } else {
                    // Mostrar mensaje de error si no hay horarios registrados para el profesor en el día actual
                    return redirect()->back()->with('error', 'No hay horarios registrados para el día de hoy');
                }

            } else {
                // Mostrar mensaje de error si el profesor no existe
                return redirect()->back()->with('error', 'El profesor con el DNI proporcionado no existe');
            }

        }
    }




    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un registro.
     */
    public function edit(Registro $registro)
    {
        // Obtener todos los profesores para el formulario de edición
        $profesores = Profesor::all();
        return view('registro.edit', compact('registro', 'profesores'));
    }

    /**
     * Actualiza los detalles de un registro en la base de datos.
     */
    public function update(Request $request, Registro $registro)
    {
        // Validación de campos
        $request->validate([
            'profesor_id' => 'required|exists:profesors,id',
            'fecha_registro' => 'nullable|date',
            'hora_registro' => 'nullable|date_format:H:i:s',
        ]);

        // Actualizar el registro en la base de datos
        $registro->update($request->all());

        return redirect()->route('registro.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Elimina un registro de la base de datos.
     */
    public function destroy(Registro $registro)
    {
        // Eliminar el registro de la base de datos
        $registro->delete();

        return redirect()->route('registro.index')->with('success', 'Registro eliminado correctamente.');
    }
}
