<?php

namespace App\Http\Controllers;
use App\Models\Profesor;
use Illuminate\Http\Request;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\RendererInterface;
use BaconQrCode\Writer;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\Color\Rgb;
use Barryvdh\DomPDF\Facade\Pdf;

class QrController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-qr|crear-qr|editar-qr|borrar-qr')->only('index');
        $this->middleware('permission:crear-qr', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-qr', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-qr', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('qr.index');
    }

    public function store(Request $request)
{
    $profesor = Profesor::where('DNI', $request->input('DNI'))->first();

    if ($profesor !== null) {
        // El profesor con el DNI proporcionado existe en la base de datos

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

        // Generar el PDF
        $pdf = Pdf::loadView('qr.pdf', compact('profesor'));

        // Guardar el PDF en la carpeta public/pdf
        $pdfPath = 'pdf/profesor_' . $profesor->id . '.pdf';
        $pdf->save(public_path($pdfPath));

        return redirect()->route('qr.index')
            ->with('create', 'Codigo Qr Generado')
            ->with('qrCode', 'profesor_' . $profesor->id . '.png')
            ->with('profesor', $profesor)
            ->with('pdfPath', $pdfPath);
    } else {
        // El profesor con el DNI proporcionado no existe en la base de datos

        return redirect()->route('qr.index')
            ->with('error', 'El DNI proporcionado no existe en la base de datos.');
    }
    // public function store(Request $request)
    // {
    //     $profesor = Profesor::where('DNI', $request->input('DNI'))->first();

    //     if ($profesor !== null) {
    //         // El profesor con el DNI proporcionado existe en la base de datos

    //         $qrCodeText = $profesor->DNI;

    //         $renderer = new ImageRenderer(
    //             new RendererStyle(400),
    //             new ImagickImageBackEnd()
    //         );

    //         $writer = new Writer($renderer);
    //         $writer->writeFile($qrCodeText, public_path('qrcodes/profesor_' . $profesor->id . '.png'));

    //         // Guardar el nombre del archivo del código QR en el profesor
    //         $profesor->qr_code = 'profesor_' . $profesor->id . '.png';
    //         $profesor->save();

    //         return redirect()->route('qr.index')->with('create', 'Codigo Qr Generado')->with('qrCode', 'profesor_' . $profesor->id . '.png');
    //     } else {
    //         // El profesor con el DNI proporcionado no existe en la base de datos

    //         return redirect()->route('qr.index')->with('error', 'El DNI proporcionado no existe en la base de datos.');
    //     }
    // }










    /////////////////
    // public function store(Request $request)
    //     {
    //         $profesor = Profesor::where('DNI', $request->input('DNI'))->first();

    //         if ($profesor !== null) {
    //             // El profesor con el DNI proporcionado existe en la base de datos

    //             $qrCodeText = $profesor->DNI;

    //             $renderer = new ImageRenderer(
    //                 new RendererStyle(400),
    //                 new ImagickImageBackEnd()
    //             );

    //             $writer = new Writer($renderer);
    //             $writer->writeFile($qrCodeText, public_path('qrcodes/profesor_' . $profesor->id . '.png'));

    //             // Guardar el nombre del archivo del código QR en el profesor
    //             $profesor->qr_code = 'profesor_' . $profesor->id . '.png';
    //             $profesor->save();

    //             return redirect()->route('qr.index')
    //                 ->with('create', 'Codigo Qr Generado')
    //                 ->with('qrCode', 'profesor_' . $profesor->id . '.png')
    //                 ->with('profesor', $profesor);
    //         } else {
    //             // El profesor con el DNI proporcionado no existe en la base de datos

    //             return redirect()->route('qr.index')
    //                 ->with('error', 'El DNI proporcionado no existe en la base de datos.');
    //         }
    //     }

    





        
}
}


