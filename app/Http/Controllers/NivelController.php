<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    function __construct()
    {
        // Definir middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-nivel|crear-nivel|editar-nivel|borrar-nivel')->only('index');
        $this->middleware('permission:crear-nivel', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-nivel', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-nivel', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todos los niveles.
     */
    public function index()
    {
        // Obtener todos los niveles
        $niveles = Nivel::all();
        return view('nivel.index', compact('niveles'));
    }

    /**
     * Muestra el formulario para crear un nuevo nivel.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear un nuevo nivel
        return view('nivel.create');
    }

    /**
     * Almacena un nuevo nivel en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:15',
        ]);

        // Crear el nivel en la base de datos
        Nivel::create($request->all());

        return redirect()->route('nivel.index')->with('success', 'Nivel creado correctamente.');
    }

    /**
     * Muestra los detalles de un nivel específico.
     */
    public function show(Nivel $nivel)
    {
        // Aquí puedes retornar la vista para mostrar los detalles de un nivel específico
    }

    /**
     * Muestra el formulario para editar un nivel.
     */
    public function edit(Nivel $nivel)
    {
        // Aquí puedes retornar la vista para editar un nivel
        return view('nivel.edit', compact('nivel'));
    }

    /**
     * Actualiza los detalles de un nivel en la base de datos.
     */
    public function update(Request $request, Nivel $nivel)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:15',
        ]);

        // Actualizar el nivel en la base de datos
        $nivel->update($request->all());

        return redirect()->route('nivel.index')->with('success', 'Nivel actualizado correctamente.');
    }

    /**
     * Elimina un nivel de la base de datos.
     */
    public function destroy(Nivel $nivel)
    {
        // Eliminar el nivel de la base de datos
        $nivel->delete();

        return redirect()->route('nivel.index')->with('success', 'Nivel eliminado correctamente.');
    }
}
