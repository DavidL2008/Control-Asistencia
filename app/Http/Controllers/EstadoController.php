<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    function __construct()
    {
        // Definir middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-estado|crear-estado|editar-estado|borrar-estado')->only('index');
        $this->middleware('permission:crear-estado', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-estado', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-estado', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todos los grados.
     */
    public function index()
    {
        // Obtener todos los grados
        $estados = Estado::all();
        return view('estado.index', compact('estados'));
    }

    /**
     * Muestra el formulario para crear un nuevo grado.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear un nuevo grado
        return view('estado.create');
    }

    /**
     * Almacena un nuevo grado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required',
        ]);

        // Crear el grado en la base de datos
        Estado::create($request->all());

        return redirect()->route('estado.index')->with('success', 'Grado creado correctamente.');
    }

    /**
     * Muestra los detalles de un grado específico.
     */
    public function show(Estado $grado)
    {
        // Aquí puedes retornar la vista para mostrar los detalles de un grado específico
    }

    /**
     * Muestra el formulario para editar un grado.
     */
    public function edit(Estado $grado)
    {
        // Aquí puedes retornar la vista para editar un grado
        return view('estado.edit', compact('estado'));
    }

    /**
     * Actualiza los detalles de un grado en la base de datos.
     */
    public function update(Request $request, Estado $estado)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required',
        ]);

        // Actualizar el grado en la base de datos
        $estado->update($request->all());

        return redirect()->route('estado.index')->with('success', 'Grado actualizado correctamente.');
    }

    /**
     * Elimina un grado de la base de datos.
     */
    public function destroy(Estado $estado)
    {
        // Eliminar el grado de la base de datos
        $estado->delete();

        return redirect()->route('Estado.index')->with('success', 'Grado eliminado correctamente.');
    }
}
