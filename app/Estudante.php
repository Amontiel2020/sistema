<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Pagamento;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class Estudante extends Model
{
   protected $fillable = [
      'nome', 'apelido', 'curso', 'curso_id', 'email', 'img', 'anoAdmissao', 'anoAcademico', 'estado', 'dataNac', 'idade',
      'BI', 'genero', 'naturalDe', 'nacionalidade', 'paisOrigem', 'nomePai', 'nomeMai',
      'provRecidencia', 'provincia_id', 'munRecidencia', 'municipio_id', 'eduEspecial', 'trabalhador', 'nivel', 'telefone1', 'telefone2', 'endereco', 'provinciaEndereco_id', 'municipioEndereco_id', 'pathImage'
   ];

   /*   public function pagamentos()
  {
      return $this->hasMany(Pagamento::class);
      //return $this->belongsTo('App\Note');
  }*/

   /* public function setPathImageAttribute($path){
        $this->attributes['pathImage']=Carbon::now()->second.$path->getClientOriginalName();
        $name=Carbon::now()->second.$path->getClientOriginalName();
        \Storage::disk('local')->put($name,\File::get($path));
      }*/
   public function Curso()
   {
      return $this->belongsTo('App\Curso');
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
   public function documentos()
   {
      return $this->belongsToMany('App\DocumentoCandidatura', 'estudante_documento', 'estudante_id', 'documento_id');
   }
   public function inscricoes()
   {
      return $this->hasMany('App\Inscricao');
   }

   public function has_conta($id)
   {
      $conta = Conta::where('estudante_id', $id)->first();
      if ($conta != null) {
         return true;
      } else if ($conta == null) {
         return false;
      }
   }



   /* public function scopeBuscarpor($tipo, $buscar)
   {
      if (($tipo) && ($buscar)) {
         return $query->where($tipo, 'like', "%$buscar%");
      }
   }*/
   public static function setImagen($foto, $actual = false)
   {
      if ($foto) {
         if ($actual) {
            Storage::disk('public')->delete("estudantes/$actual");
         }
         $imageName = Str::random(20) . 'jpg';
         $imagen = Image::make($foto)->encode('jpg', 75);
         $imagen->resize(500, 500, function ($contraint) {
            $contraint->upsize();
         });
         Storage::disk('public')->put("estudantes/$imageName", $imagen->stream());
         return $imageName;
      } else {
         return false;
      }
   }

   public static function toString($id)
   {
      if ($id == 0) {
         return "Candidato";
      } else {
         $estudante = Estudante::where('id', $id)->first();
         return $estudante->nome;
      }
   }

   public static function estudantes($id)
   {
      return Estudante::where('turma_id', $id)->get();
   }

   public function getNome($id)
   {
      $estudante = Estudante::where('id', $id)->first();
      return $estudante->nome;
   }


   public function pago($idEstudante, $mes, $ano)
   {
      //$idEst="'".$idEstudante."'";
      $mes2 = "'" . $mes . "'";
      $ano2 = "'" . $ano . "'";

      //echo $mes2;
      $pago = Pagamento::where([
         'estudante_id' => $idEstudante,
         'mes' => $mes,
         'ano' => $ano
      ])->first();

      if ($pago == null) {
         return 'false';
      } else {
         return 'true';
      }
   }

   public function pagamentos($ano)
   {

      $pagamentos = Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $this->id])->orderby('mes', 'asc')->get();
      //$pagamentos=Pagamento::where(['emolumento_id'=>1,'ano'=>$ano,'estudante_id'=>$this->id])->get();

      return $pagamentos;
   }

   public function cantidadMesesPagos($ano)
   {
      return  $this->pagamentos($ano)->count();
   }


   public function inpagos($ano)
   {

      $total = 12;

      $pagos = Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $this->id])->count();

      return $total - $pagos;
   }
   public function test()
   {
      echo "OK";
   }

   public function mesesSinPagar($ano)
   {
      return Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $this->id])->pluck('mes', 'id');
   }

   public static function obterDisciplinasAtrasoDadoEstudante($idEst)
   {
      $estudante = Estudante::where('id', $idEst)->first();

      $disciplinasAtrasso = collect();
      $inscricoes = Inscricao::where('estudante_id', $estudante->id)->get();
      foreach ($inscricoes as $inscricao) {
         if ($inscricao->semestre == "I") {
            foreach ($inscricao->disciplinas as $disciplina) {
               if (\App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, $inscricao->anoAcademico) < 10) {
                  // if ($disciplina->pivot->estado == "Reprovado") {
                  $disciplinasAtrasso->push($disciplina->pivot->disciplina_id);
               }
            }
         }
      }
      // dd($disciplinasAtrasso);
      return $disciplinasAtrasso;
   }

   public static function listaRecursos($estudante_id)
   {
      // $avals = Avaliacao::where('estudante_id', $estudante_id)->where('tipo', 'Ex2')->get();

      $resultado = DB::table('avaliacaos')->where('tipo', 'Ex2')
         ->join('estudantes', function ($join) use ($estudante_id) {
            $join->on('estudantes.id', '=', 'avaliacaos.estudante_id')
               ->where('estudantes.id', $estudante_id);
         })->join('disciplinas', 'disciplinas.id', '=', 'avaliacaos.disciplina_id')->where('semestre', 'II')
         ->select('estudantes.nome', 'estudantes.apelido', 'disciplinas.nome as disciplina_nome')
         ->groupBy('estudantes.nome', 'estudantes.apelido', 'disciplinas.nome')
         ->get();
      return $resultado;
   }
   public static function listaEx3($estudante_id)
   {
      // $avals = Avaliacao::where('estudante_id', $estudante_id)->where('tipo', 'Ex2')->get();

      $resultado = DB::table('avaliacaos')->where('tipo', 'Ex3')
         ->join('estudantes', function ($join) use ($estudante_id) {
            $join->on('estudantes.id', '=', 'avaliacaos.estudante_id')
               ->where('estudantes.id', $estudante_id);
         })->join('disciplinas', 'disciplinas.id', '=', 'avaliacaos.disciplina_id')->where('semestre', 'II')
         ->select('estudantes.nome', 'estudantes.apelido', 'disciplinas.nome as disciplina_nome')
         ->groupBy('estudantes.nome', 'estudantes.apelido', 'disciplinas.nome')
         ->get();
      return $resultado;
   }
   public static function getPeriodo($id)
   {
      $estudante = Estudante::find($id);
      $turma = Turma::find($estudante->turma_id);
      $periodo = "";
      if ($estudante != null && $turma != null) {
         if ($turma->periodo == "M" || $turma->periodo == "T") {
            $periodo = "Regular";
         }
         if ($turma->periodo == "N") {
            $periodo = "Pós-Laboral";
         }
      }
      return $periodo;
   }
   public static function getProvincia($id)
   {
      $estudante = Estudante::find($id);

      if ($estudante != null) {
         $provincia = Provincia::find($estudante->provincia_id);
         return $provincia != null ? $provincia->nome : "";
      } else {
         return "";
      }
   }
   public static function getMunicipio($id)
   {
      $estudante = Estudante::find($id);

      if ($estudante != null) {
         $municipio = Municipio::find($estudante->municipio_id);
         return $municipio != null ? $municipio->nome : "";
      } else {
         return "";
      }
   }
   public static function getAproveitamento($id)
   {
      $estudante = Estudante::find($id);
      $aproveitamento = "";
      $reprovado = 0;
      if ($estudante->estado == "Desistente") {
         $aproveitamento = "Reprovado por abandono";
      }
      if ($estudante->estado == "anulado" || $estudante->estado == "anulada" || $estudante->estado == "Anulado" || $estudante->estado == "Anulada") {
         $aproveitamento = "Reprovado por licença";
      }
      if ($estudante->estado == "Activo") {
         $inscricoes = Inscricao::where('estudante_id', $estudante->id)->where("anoAcademico", 2021)->get();
         foreach ($inscricoes as $inscricao) {
            // if ($inscricao->semestre == "I") {
            foreach ($inscricao->disciplinas as $disciplina) {
               if (\App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, $inscricao->anoAcademico) < 10) {
                  $reprovado++;
               }
            }
            // }
         }
         if ($reprovado == 0) {
            $aproveitamento = "Aprovado em todas";
         } else {
            $aproveitamento = "Aprovado com cadeiras em atraso";
         }
      }
      return $aproveitamento;
   }

   public static function obterTodasDisciplinasAtrasoDadoEstudante($idEst)
   {
      $estudante = Estudante::where('id', $idEst)->first();

      $disciplinasAtrasso = collect();
      $inscricoes = Inscricao::where('estudante_id', $estudante->id)->where("anoAcademico", 2021)->get();
      foreach ($inscricoes as $inscricao) {
         //  if ($inscricao->semestre == "I") {
         foreach ($inscricao->disciplinas as $disciplina) {
            if (\App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, $inscricao->anoAcademico) < 10 && \App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, $inscricao->anoAcademico) != null) {
               // if ($disciplina->pivot->estado == "Reprovado") {
               $disciplinasAtrasso->push($disciplina->pivot->disciplina_id);
            }
         }
         // }
      }
      // dd($disciplinasAtrasso);
      return $disciplinasAtrasso;
   }

   public static function pagamentoCartao($id)
   {
      // $estudante=Estudante::find($id);
      $pagamento = Pagamento::where("estudante_id",$id)->where("emolumento_id", 32)->first();
      if ($pagamento != null)
         return true;
      else
         return false;
   }
}
