<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Candidato extends Model
{
    protected $fillable = [
        'codigo', 'nomeCompleto', 'curso_id', 'email', 'img', 'anoAcademico', 'estado', 'matriculado', 'dataNac', 'idade',
        'BI', 'dataEmissaoBI', 'dataValidadeBI', 'genero', 'naturalDe', 'nacionalidade', 'paisOrigem', 'nomePai', 'nomeMai',
        'provRecidencia', 'munRecidencia', 'eduEspecial', 'trabalhador', 'nivel', 'telefone1', 'telefone2', 'telefoneEmergencia', 'endereco', 'pathImage'
    ];

    public function Processo()
    {
        return $this->belongsTo('App\ProcessoCandidatura');
    }

    public function Avaliacoes()
    {
        return $this->hasMany('App\AvaliacaoCandidatura');
    }

    public function documentos()
    {
        return $this->belongsToMany('App\DocumentoCandidatura', 'candidato_documento', 'candidato_id', 'documento_id');
    }
    public function Provincia()
    {
        return $this->belongsTo('App\Provincia');
    }
    public function Municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function ProvinciaEndereco()
    {
        return $this->belongsTo('App\Provincia', 'provinciaEndereco_id');
    }
    public function MunicipioEndereco()
    {
        return $this->belongsTo('App\Municipio', 'municipioEndereco_id');
    }

    public function contactos()
    {
        return $this->belongsToMany('App\Contacto', 'candidato_contacto', 'candidato_id', 'contacto_id');
    }

    public function obterAval($proc, $exame, $candidato_id)
    {
        $aval = AvaliacaoCandidatura::where('processo_id', $proc)->where('exame_id', $exame)->where('candidato_id', $candidato_id)->first();

        if ($aval != null) {
            return $aval->valor;
            //  } else {
            //   return 0;
        }
    }
    public function obterMedia($proc, $candidato_id)
    {
        $avals = AvaliacaoCandidatura::where('processo_id', $proc)->where('candidato_id', $candidato_id)->get();

        if ($avals != null) {
            $soma = $avals->sum('valor');
            $cant = $avals->count();
            if ($cant != 0) {
                return $soma / $cant;
            }
        } else {
            return -1;
        }
    }

    public function obterMediaPorCiento($proc, $candidato_id)
    {
        $avals = AvaliacaoCandidatura::where('processo_id', $proc)->where('candidato_id', $candidato_id)->get();


        $media = 0;
        if ($avals != null) {
            foreach ($avals as  $aval) {
                $registrosCurso = DB::table('curso_exame')->where('exame_id', '<>', $aval->exame_id)->where('curso_id', $aval->candidato->curso_id)->first();
                $peso = $registrosCurso->peso;
                $media += ($aval->valor * $peso) / 100;
            }
        }
        return $media;
    }


    public function obterAvaliacoes($candidato_id, $processo_id)
    {
        $avaliacoes = AvaliacaoCandidatura::where('processo_id', $processo_id)->where('candidato_id', $candidato_id)->get();

        return $avaliacoes;
    }
    public static function obterAvaliacoes2($candidato_id, $processo_id)
    {
        $avaliacoes = AvaliacaoCandidatura::where('processo_id', $processo_id)->where('candidato_id', $candidato_id)->get();

        return $avaliacoes;
    }
    public static function obterExames($curso_id)
    {
        $exames = ExameCandidatura::where('curso_id', $curso_id)->get();

        return $exames;
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

    public function verificarEmail($valor)
    {
        $estudante = Estudante::where('email', $valor)->first();
        if ($estudante != null) {
            return true;
        } else {
            return false;
        }
    }


    public static function toString($codigo)
    {
        $candidato = Candidato::where('codigo', $codigo)->first();
        if ($candidato != null) {
            return $candidato->nomeCompleto;
        } else {
            return "";
        }
    }

    public static function getProvincia($id)
    {
        $candidato = Candidato::find($id);

        if ($candidato != null) {
            $provincia = Provincia::find($candidato->provincia_id);
            return $provincia != null ? $provincia->nome : "";
        } else {
            return "";
        }
    }
    public static function getMunicipio($id)
    {
        $candidato = Candidato::find($id);

        if ($candidato != null) {
            $municipio = Municipio::find($candidato->municipio_id);
            return $municipio != null ? $municipio->nome : "";
        } else {
            return "";
        }
    }
    public static function getIdade($id)
    {
        $candidato = Candidato::find($id);
        $dataNac = $candidato->dataNac;
        $actual = Carbon::now();
        $edad = $actual->diffForHumans($dataNac, $actual);

        $edad2 = (int) filter_var($edad, FILTER_SANITIZE_NUMBER_INT);
        return $edad2;
    }
}
