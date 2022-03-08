<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Estudante;
use App\Turma;


class ListaCartaoExport  implements FromView
{

    public $estudantes;

   

    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function ListaCartaoExport()
    {
    }
    public function view(): View
    {
       
        $estudantes = Estudante::where('estado', 'activo')->where('turma_id', $this->id)->orderby('nome', 'asc')->get();
       // $estudantes = Estudante::where('estado', 'activo')->where('turma_id', $this->id)->get();
        
        $turma=Turma::find($this->id);
      
        return view('Estudantes.listaCartao', compact('estudantes','turma'));
    }
}
