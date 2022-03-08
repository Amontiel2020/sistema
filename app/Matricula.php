<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public $incrementing = false;
    protected $fillable = ['codigo', 'periodo', 'email', 'url', 'estado'];

    public function getKeyName()
    {
        return "codigo";
    }
    public function candidato()
    {
        return $this->belongsTo('App\Candidato', 'codCandidato');
    }

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'codFactura');
    }
    public function estudante()
    {
        return $this->belongsTo('App\Factura', 'codEstudante');
    }
}
