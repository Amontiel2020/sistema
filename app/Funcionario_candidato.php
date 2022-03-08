<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario_candidato extends Model
{
    protected $fillable = ['nomeCompleto','sexo','estado_civil','data_nascimento','num_filhos','num_bi','data_emissao_bi','data_validade_bi','num_contribuinte','num_seguranca_social','nome_pai','nome_mai','provincia','municipio','nacionalidade',
    'salario_base','categoria_prof','data_admissao','tipo_contrato','telef1','telef2','morada'
   ];
}
