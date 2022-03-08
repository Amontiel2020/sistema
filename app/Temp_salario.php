<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_salario extends Model
{
    protected $fillable=['horas_faltas','desconto_faltas','subcidio_funcao','subsidio_outros_adicionais',
    'salario_liquido','base_incedencia','desconto_seguridad_social','desconto_irt','desconto_outros','total_descontos',
     'subsidio_natal','subsidio_ferias','subsidio_outros','abono_emprestimo','salario_receber'
];

public function funcionario()
{
    return $this->belongsTo('App\Funcionario');
}

public function mapa()
{
    return $this->belongsTo('App\Mapa_salario');
}
    
}
