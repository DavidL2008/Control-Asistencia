<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Registro;
use App\Models\Profesordetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
 // Importa la clase PDF de Dompdf

 class PDFController extends Controller
 {
     public function generarPdf(Request $request)
     {
         // Verificar el tipo de lista solicitada
         if ($request->has('tipo') && $request->tipo == 'horarios') {
             $data = [
                 'horarios' => Horario::get(),
                 'profesores' => Profesor::get()
             ];
             $nombre_pdf = 'lista-horarios.pdf';
             $vista_pdf = 'horario.pdf';
         }elseif ($request->has('tipo') && $request->tipo == 'profesores'){
             $data = [
                 'profesores' => Profesor::get()
             ];
             $nombre_pdf = 'lista-profesores.pdf';
             $vista_pdf = 'profesor.pdf';
         } elseif ($request->has('tipo') && $request->tipo == 'profesordetalles'){
            $data = [
                'profesordetalles' => Profesordetalle::get()
            ];
            $nombre_pdf = 'lista-profesordetalle.pdf';
            $vista_pdf = 'profesordetalle.pdf';
        }elseif ($request->has('tipo') && $request->tipo == 'registros'){
            $data = [
                'registros' => Registro::get()
            ];
            $nombre_pdf = 'lista-registro.pdf';
            $vista_pdf = 'registro.pdf';
        }

         // Cargar la vista PDF en una variable
         $pdf = PDF::loadView($vista_pdf, $data);

         // Devolver el PDF para ser mostrado en el navegador
         return $pdf->stream($nombre_pdf);
     }
 }


