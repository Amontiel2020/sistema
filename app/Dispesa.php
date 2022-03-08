<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dispesa extends Model
{
    protected $fillable = [
        'mes', 'ano','valor','departamento_id','descricao','meioPagamento','numFactura','natureza','fornecedor'
    ];


    public function area()
{
    return $this->belongsTo(Departamento::class);
}
}
