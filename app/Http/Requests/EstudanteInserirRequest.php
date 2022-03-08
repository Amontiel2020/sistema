<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EstudanteInserirRequest extends Request{

    public function authorize(){
    return true;

    }

    public function rules(){
    return [
        'nome' => 'required',
        'apelido'=>'required'
        
    ];
}

}



