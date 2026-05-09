<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use Carbon\Carbon;
use App\Models\registro;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\RegistroController;

class LectorController extends Controller
{
    public function index()
    {
        return view('lector.index');
    }
    public function lectorQr(Request $request)
    {
        Log::info('Datos recibidos',$request->all());
        // Validar el dato recibido
        $request->validate([
            'qrData' => 'required'
        ]);

        // Buscar el profesor por DNI obtenido del QR
        $profesor = Profesor::where('DNI', $request->input('qrData'))->first();

        if ($profesor) {
            // Llama al método store del RegistroController para registrar al profesor
            $registroController = new RegistroController();
            $response = $registroController->store(new Request(['DNI' => $profesor->DNI])); // Pasar el DNI al método store

            // Verificar la respuesta y manejarla adecuadamente
            if ($response->isRedirection()) {
                // Si es una redirección, devuelve la misma redirección
                return $response;
            } elseif ($response->isSuccessful()) {
                // Si la operación fue exitosa, responde con éxito
                return response()->json(['success' => true, 'message' => 'Registro agregado correctamente']);

            } else {
                // Si hubo un error, responde con error
                return response()->json(['success' => false, 'message' => 'Error al registrar el profesor']);
            }
        } else {
            // Responder con error si el profesor no existe
            return response()->json(['success' => false, 'message' => 'El profesor con el ID proporcionado no existe.']);
        }
    }
}
