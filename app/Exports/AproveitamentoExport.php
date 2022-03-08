<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Estudante;

class AproveitamentoExport  implements FromView
{

    public $estudantes;

   

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
       
        $estudantes = Estudante::where('estado',"<>", "candidato")->where("anoAdmissao",2020)->orderBy("curso_id","asc")->get();
 
      
        return view('Estudantes.aproveitamento', compact('estudantes'));
    }
}
