<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Caixa;

class DiarioBancoExport implements FromView
{
    public function DiarioBancoExport(){}
  
    public function view(): View {
        $collection=Caixa::obtenerEntradaSalida(12,2020);
        return view('caixa.diarioBancoExport',compact('collection'));
    }
}
