<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class Emolumento extends Model
{
  protected $fillable = [
    'nome', 'valor'
  ];


  public static function toString($id)
  {
    $emolumento = Emolumento::where('id', $id)->first();

    if ($emolumento != null) {
      return $emolumento->nome;
    } else {
      return "";
    }
  }

  public static function toStringMes($mes)
  {

    $resultado = "";

    switch ($mes) {
      case 3:
        $resultado = "Março";
        break;
      case 4:
        $resultado = "Outubro";
        break;
      case 5:
        $resultado = "Novembro";
        break;
      case 6:
        $resultado = "Dezembro";
        break;
      case 7:
        $resultado = "Janeiro";
        break;
      case 8:
        $resultado = "Fevereiro";
        break;
      case 9:
        $resultado = "Março 2021";
        break;
      case 10:
        $resultado = "Abril";
        break;
      case 11:
        $resultado = "Maio";
        break;
      case 12:
        $resultado = "Junho";
        break;

      default:
        # code...
        break;
    }
    return $resultado;
  }

  public static function valorEmolumento($id)
  {
    $emolumento = Emolumento::find($id);
    return $emolumento->valor;
  }
}
