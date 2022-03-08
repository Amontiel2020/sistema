<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{

    protected $fillable = [
        'numero', 'estudante_id', 'saldo', 'totalPagar', 'totalTaxas', 'is_contencioso'
    ];


    public function estudante()
    {
        return $this->belongsTo('App\Estudante');
    }

    public function pagamentos()
    {
        return $this->hasMany('App\Pagamento');
    }

    public function operacoes()
    {
        return $this->hasMany('App\Operacao');
    }
    public static function mesPago($idConta, $mes, $anoAcad)
    {
        $conta = Conta::find($idConta);


        $pagamento = Pagamento::where('conta_id', $idConta)->where('mes', $mes)->where('ano', $anoAcad)->first();

        if ($pagamento != null) {
            return true;
        } else if ($pagamento == null) {
            return false;
        }
    }

    public static function is_contencioso($estudante_id)
    {
        $conta = Conta::where('estudante_id', $estudante_id)->first();
        if ($conta->is_contencioso == 1) {
            return true;
        } else if ($conta->is_contencioso == 0) {
            return false;
        }
    }
}
