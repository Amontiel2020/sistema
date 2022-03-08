<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $fillable = ['codigo', 'anoCurricular', 'anoAcademico', 'semestre'];

    public function estudante()
    {
        return $this->belongsTo('App\Estudante');
    }
    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function disciplinas()
    {
        return $this->belongsToMany('App\Disciplina', 'inscricao_disciplina', 'inscricao_id', 'disciplina_id')->withPivot('estado', 'classif');
    }

    public function disciplinasAtraso()
    {
        return $this->belongsToMany('App\Disciplina', 'disciplinasatraso', 'inscricao_id', 'disciplina_id')->withPivot('estado', 'classif');
    }

    public static function getInscricoes($idDisc, $anoAcademico, $turma)
    {
        $inscricoes = Inscricao::where('anoAcademico', $anoAcademico)->get();
        $estudantes = collect();
        if ($turma == "todos") {
            foreach ($inscricoes as $inscricao) {
                foreach ($inscricao->disciplinas as $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $idDisc) {
                        $estudante = Estudante::where('id', $inscricao->estudante_id)->first();
                        $estudantes->push($estudante);
                    }
                }
                //Atraso
                foreach ($inscricao->disciplinasAtraso as $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $idDisc) {
                        $estudante = Estudante::where('id', $inscricao->estudante_id)->first();
                        $estudantes->push($estudante);
                    }
                }
            }
        } else {
            foreach ($inscricoes as $inscricao) {
                foreach ($inscricao->disciplinas as $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $idDisc) {
                        $estudante = Estudante::where('id', $inscricao->estudante_id)->first();
                        if($estudante->turma_id==$turma){
                            $estudantes->push($estudante);
                        }
                        
                    }
                }
                //Atraso
                foreach ($inscricao->disciplinasAtraso as $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $idDisc) {
                        $estudante = Estudante::where('id', $inscricao->estudante_id)->first();
                        if($estudante->turma_id==$turma){
                            $estudantes->push($estudante);
                        }
                    }
                }
            }
        }
        // dd($estudante);
        return $estudantes;
    }
}
