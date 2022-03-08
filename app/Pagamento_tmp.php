<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Estudante;

class Pagamento_tmp extends Model
{
  protected $fillable = [
    'valor', 'taxa', 'mes', 'ano', 'emolumento_id', 'estudante_id', 'obs','descrip','desconto'
  ];

    public function conta()
    {
        return $this->belongsTo('App\Conta');
    }


 
 
}
