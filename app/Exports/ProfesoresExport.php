<?php

namespace App\Exports;
use App\Models\profesor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProfesoresExport implements FromCollection
{
    public function collection()
    {
        return profesor::all();
    }
}






