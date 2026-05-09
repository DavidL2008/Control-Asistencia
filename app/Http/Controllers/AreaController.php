<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    function __construct()
    {
        // Definir middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-area|crear-area|editar-area|borrar-area')->only('index');
        $this->middleware('permission:crear-area', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-area', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-area', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todas las áreas.
     */
    public function index()
    {
        // Obtener todas las áreas
        $areas = Area::all();
        return view('area.index', compact('areas'));
    }

    /**
     * Muestra el formulario para crear una nueva área.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear una nueva área
        return view('area.create');
    }

    /**
     * Almacena una nueva área en la base de datos.
     */
    public function store(Request $request)

    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:30',
        ]);

        // Crear el área en la base de datos
        Area::create([
            'descripcion' => $request->descripcion,
        ]);



        return redirect()->route('area.index')->with('create', 'Área creada correctamente.');
    }


    /**
     * Muestra los detalles de un área específica.
     */
    public function show(Area $area)
    {
        // Aquí puedes retornar la vista para mostrar los detalles de un área específica
    }

    /**
     * Muestra el formulario para editar un área.
     */
    public function edit(Area $area)
    {
        // Aquí puedes retornar la vista para editar un área
        return view('area.edit', compact('area'));
    }

    /**
     * Actualiza los detalles de un área en la base de datos.
     */
    public function update(Request $request, Area $area)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:30',
        ]);

        // Actualizar el área en la base de datos
        $area->update($request->all());

        return redirect()->route('area.index')->with('update', 'Área actualizada correctamente.');
    }

    /**
     * Elimina un área de la base de datos.
     */
    public function destroy(Area $area)
    {
        // Eliminar el área de la base de datos
        $area->delete();

        return redirect()->route('area.index')->with('delete', 'Área eliminada correctamente.');
    }
}

