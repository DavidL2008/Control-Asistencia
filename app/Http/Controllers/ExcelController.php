<?php
namespace App\Http\Controllers;
use App\Exports\ProfesoresExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function index()
    {
        return view('profesor.index');
    }

    public function export(){
        return Excel::download(new ProfesoresExport, 'profesor.xlsx');
    }
}



