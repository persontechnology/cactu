<?php

namespace cactu\Exports;

use cactu\Models\Registro\Asistencia;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AsistenciaExposrt implements FromView
{

    protected $idS;
    public function __construct($asis)
    {
        $this->idS=$asis;
    }

    public function view(): View
    {
        return view('registros.asistencias.exportarExcel', [
            'asis' => Asistencia::findOrFail($this->idS)
        ]);
    }
}
