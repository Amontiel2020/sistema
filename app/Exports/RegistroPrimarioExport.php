<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Candidato;

class RegistroPrimarioExport  implements FromView
{

    public $candidatos;

   

   // protected $id;

    function __construct()
    {
       // $this->id = $id;
    }

    public function PautaExport()
    {
    }
    public function view(): View
    {
       
        $candidatos = Candidato::where('processo_id', 1)->get();
 
      
        return view('candidatos.registroPrimario', compact('candidatos'));
    }
}
