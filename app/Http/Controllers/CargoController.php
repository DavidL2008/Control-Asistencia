<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    function __construct()
    {
        // Definir middleware para los permisos de las acciones del controlador
        $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo')->only('index');
        $this->middleware('permission:crear-cargo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-cargo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-cargo', ['only' => ['destroy']]);
    }

    /**
     * Muestra una lista de todas las secciones.
     */
    public function index()
    {
        // Obtener todas las secciones
        $cargos = Cargo::all();

        return view('cargo.index', compact('cargos'));
    }

    /**
     * Muestra el formulario para crear una nueva sección.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear una nueva sección
        return view('cargo.create');
    }

    /**
     * Almacena una nueva sección en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:15',
        ]);

        // Crear la sección en la base de datos
        Cargo::create($request->all());

        return redirect()->route('cargo.index')->with('create', 'Registro agregado correctamente');
    }

    /**
     * Muestra los detalles de una sección específica.
     */
    public function show(Cargo $seccion)
    {
        // Aquí puedes retornar la vista para mostrar los detalles de una sección específica
    }

    /**
     * Muestra el formulario para editar una sección.
     */
    public function edit(Cargo $cargo)
    {
        // Aquí puedes retornar la vista para editar una sección
        return view('cargo.edit', compact('cargo'));
    }

    /**
     * Actualiza los detalles de una sección en la base de datos.
     */
    public function update(Request $request, Cargo $cargo)
    {
        // Validación de campos
        $request->validate([
            'descripcion' => 'required|string|max:15',
        ]);

        // Actualizar la sección en la base de datos
        $cargo->update($request->all());

        return redirect()->route('cargo.index')->with('update', 'Registro actualizado correctamente');
    }

    /**
     * Elimina una sección de la base de datos.
     */
    public function destroy(Cargo $cargo)
    {
        // Eliminar la sección de la base de datos
        $cargo->delete();

        return redirect()->route('cargo.index')->with('delete', 'Registro eliminado correctamente');
    }
}
