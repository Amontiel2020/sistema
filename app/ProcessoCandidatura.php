<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoCandidatura extends Model
{

    protected $fillable = ['nome', 'ano','actual', 'descricao','valorDeCorte'];

    public function candidatos()
    {
        return $this->hasMany('App\Candidato','processo_id');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso', 'curso_processo', 'processo_id', 'curso_id')->withPivot('valor_inscricao');
    }

    public function exames()
    {
        return $this->hasMany('App\ExameCandidatura','processo_id');
    }
    public function pautas()
    {
        return $this->hasMany('App\PautaCandidatura');
    }


    public function documentos()
    {
        return $this->belongsToMany('App\DocumentoCandidatura','documento_processo','processo_id','documento_id');
    }
    public function contactos()
    {
       return $this->belongsToMany('App\Contacto', 'processo_contacto', 'processo_id', 'contacto_id');
    }

    public  function esta($idCurso, $coleccion)
    {
      //  dd($coleccion);
        $curso = Curso::find($idCurso);
        //   $proc = ProcessoCandidatura::find($idProc);
        if ($coleccion!=null && $coleccion->contains($curso)) {
            return true;
        } else {
            return false;
        }
    }

    public  function estaDocumento($idDoc, $coleccion)
    {
      //  dd($coleccion);
        $documento = DocumentoCandidatura::find($idDoc);
        //   $proc = ProcessoCandidatura::find($idProc);
        if ($coleccion->contains($documento)) {
            return true;
        } else {
            return false;
        }
    }

    public function existePauta($proc,$exame,$curso){
        $pauta=PautaCandidatura::where('processo_id',$proc)->where('exame_id',$exame)->where('curso_id',$curso)->first();
        if ($pauta!=null) {
            return true;
           
        }
        else{
            return false;
        }
    }
}
