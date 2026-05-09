<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use App\Exports\ProfesorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;


class ProfesorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-profesor|crear-profesor|editar-profesor|borrar-profesor')->only('index');
        $this->middleware('permission:crear-profesor', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-profesor', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-profesor', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::all();
        return view('profesor.index', compact('profesores'));
    }

    public function pdf()
    {
        $profesores = Profesor::all();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $pdf = new Dompdf($options);
        $pdf->loadHTML(view('profesor.modal.pdf', compact('profesores')));

        return $pdf->stream('profesores.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profesor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validación de campos
    $request->validate([
        'nombres' => 'required|string|max:80',
        'apellidos' => 'required|string|max:150',
        'DNI' => 'required|string|max:8',
        'numero' => 'required|string|max:9',
        'correo' => 'required|string|email',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string', // Puedes ajustar esta validación según tus requisitos
    ]);
    // Crear el profesor en la base de datos
    //Profesor::create($request->all());
    $profesor = Profesor::create($request->all());

        // Generar el código QR
        $qrCodeText = $profesor->DNI;

        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );

        $writer = new Writer($renderer);
        $writer->writeFile($qrCodeText, public_path('qrcodes/profesor_' . $profesor->id . '.png'));

        // Guardar el nombre del archivo del código QR en el profesor
        $profesor->qr_code = 'profesor_' . $profesor->id . '.png';
        $profesor->save();

    return redirect()->route('profesor.index')->with('create', 'Registro agregado correctamente');
}

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        return view('profesor.show', compact('profesor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        return view('profesor.edit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor)
    {
        // Validación de campos
        $request->validate([
            'nombres' => 'required|string|max:80',
            'apellidos' => 'required|string|max:150',
            'DNI' => 'required|string|max:8',
            'numero' => 'required|string|max:9',
            'correo' => 'required|string|email',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string', // Puedes ajustar esta validación según tus requisitos
        ]);

        // Actualizar el profesor en la base de datos
        $profesor->update($request->all());

        return redirect()->route('profesor.index')->with('update', 'Registro actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        // Eliminar el profesor de la base de datos
        $profesor->delete();

        return redirect()->route('profesor.index')->with('session', 'Profesor eliminado correctamente.');
    }









    public function obtenerProfesores()
    {
        $profesores = Profesor::all();
        return $profesores->toJson();
    }
}

