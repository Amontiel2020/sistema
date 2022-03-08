<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Entrada;
use \App\Saida;
use \App\Consumivel;



class ControladorStock extends Controller
{
    

    public function index(){
        $lista=Consumivel::paginate(10);
    return view('patrimonio.stock',compact('lista'));
}




}
