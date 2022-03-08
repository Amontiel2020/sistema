<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Pauta;
use App\Estudante;

class PautaExport  implements FromView
{

    public $estudantes;
    public $disciplina;
    public $anoAcademico;
   

    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function PautaExport()
    {
    }
    public function view(): View
    {
        $pauta = Pauta::find($this->id);
        $estudantes = Estudante::where('turma_id', $pauta->turma_id)->get();
       // $this->estudantes = $estudantes;
        $idDisc= $pauta->disciplina_id;
        $anoAcad = $pauta->anoAcademico;
      
        return view('pautas.pautaExport', compact('estudantes', 'idDisc', 'anoAcad'));
    }
}
