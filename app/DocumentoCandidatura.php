<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoCandidatura extends Model
{
  protected $fillable=['nome','descricao'];


  public function ProcessosCandidaturas()
  {
      return $this->belongsToMany('App\ProcessoCandidatura');
  }

 
}
