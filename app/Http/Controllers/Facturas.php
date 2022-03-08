<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidato;
use App\Factura;


class Facturas extends Controller
{
    public function listarFacturasCandidaturas()
    {
        $candidaturas = Candidato::where('estado', 'Candidato')->get();
        $facturas = Factura::where('tipo', 'Candidatura')->where('estado', 'Emitida')->get();
 
        return view('caixa.incricoes', compact('candidaturas', 'facturas'));
    }
    public function actualizarFormaPago(Request $request)
    {
        if ($request->ajax()) {
            $factura_id = $request->input('pk');
            $forma_pago = $request->input('value');
            $factura=Factura::find($factura_id);
            $factura->formaPagamento=$forma_pago;
            $factura->save();

            return response()->json(['success' => true]);
        }
    }
}
