<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagamento;
use App\Dispesa;

use Barryvdh\DomPDF\Facade as PDF;

class Relatorios extends Controller
{


public function ingresos()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $inscricoes=Pagamento::where(['ano'=>2020,'mes'=>1])->get();
        $matriculas=Pagamento::where(['ano'=>2020,'mes'=>2])->get();
        $propinas=Pagamento::where(['ano'=>2020,'mes'=>3])->get();

          $valorInscricao=0;
          $valorMatricula=0;
          $valorPropina=0;

        foreach($inscricoes as $inscricao){
            $valorInscricao+=$inscricao->valor;
        }
        
        
        foreach($matriculas as $matricula){
            $valorMatricula+=$matricula->valor;
        }
        foreach($propinas as $propina){
            $valorPropina+=$propina->valor;
        }
        $total=$valorInscricao+$valorMatricula+$valorPropina;

        $pdf = PDF::loadView('relatorios.ingresos', compact('valorInscricao','valorMatricula','valorPropina','total'));

        return $pdf->download('ingresos.pdf');
    }

    public function test($mes){
        $dispesas=Dispesa::whereMonth('created_at',$mes)->get();
       // $customPaper = array(0,0,567.00,283.80);
        //$pdf = PDF::loadView('pdf.retourlabel', compact('retour','barcode'))->setPaper($customPaper, 'landscape');
        $pdf = PDF::loadView('relatorios.test',compact('dispesas'))->setPaper("letter", "landscape");
      //  PDF::set_paper("A4", "portrait");
        return $pdf->download('test.pdf');
    }

}