<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Funcionario;
use App\Provincia;
use App\Municipio;
use App\Funcionario_candidato;
use App\Subsidio;
use App\Documento_funcionario;
use App\Feria;
use App\Mapa_salario;
use App\Temp_salario;
use App\Grupo_funcionario;
use App\Hab_literaria;
use App\Lingua;
use App\Tipo_contrato;

use Barryvdh\DomPDF\Facade as PDF;
use File;




class Funcionarios extends Controller
{
    public function index()
    {
        $lista = Funcionario::orderBy('nome_completo', 'asc')->get();
        return view('funcionarios.index', compact('lista'));
    }
    public function listar_candidato()
    {
        $lista = Funcionario_Candidato::all();
        return view('funcionarios.listar_funcionarios_candidatos', compact('lista'));
    }
    public function inserir()
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');
        $subsidios = Subsidio::all();
        $documentos = Documento_funcionario::all();
        $grupos = Grupo_funcionario::all();
        $contratos = Tipo_contrato::all();
        $habilitacoes = Hab_literaria::all();
        $idiomas = Lingua::all();

        return view('funcionarios.inserir', compact('provincias', 'municipios', 'date', 'subsidios', 'documentos', 'grupos', 'contratos', 'habilitacoes', 'idiomas'));
    }

    public function inserir_candidato()
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');
        $documentos = Documento_funcionario::all();
        return view('funcionarios.inserir_candidato', compact('provincias', 'municipios', 'date', 'documentos'));
    }

    public function store_funcionario(Request $request)
    {

        $funcionario = new Funcionario();

        $funcionario->nome_completo = $request->nome_completo;
        $funcionario->sexo = $request->sexo;
        $funcionario->estado_civil = $request->estado_civil;
        $funcionario->data_nac = $request->data_nac;
        $funcionario->numero_filhos = $request->numero_filhos;
        $funcionario->numero_bi = $request->numero_bi;
        $funcionario->data_emissao_bi = $request->data_emissao_bi;
        $funcionario->data_validade_bi = $request->data_validade_bi;
        $funcionario->nome_pai = $request->nome_pai;
        $funcionario->nome_mae = $request->nome_mae;
        $funcionario->provincia = $request->provincia;
        $funcionario->municipio = $request->municipio;
        $funcionario->nacionalidade = $request->nacionalidade;
        $funcionario->telefone1 = $request->telefone1;
        $funcionario->telefone2 = $request->telefone2;
        $funcionario->provincia_morada = $request->provincia_morada;
        $funcionario->municipio_morada = $request->municipio_morada;
        $funcionario->zona_morada = $request->zona_morada;
        $funcionario->salario_base = $request->salarioBase;
        $funcionario->categoria_prof = $request->categoria_prof;
        $funcionario->tempo_exp_prof = $request->tempo_exp_prof;
        $funcionario->tipo_contrato_id = $request->tipo_contrato;
        $funcionario->categoria_ocupacional = $request->categoria_ocupacional;

        $funcionario->data_admissao = $request->data_admissao;



        $funcionario->grupo_funcionario_id = $request->grupo;



        $file = $request->file('imagenperfil');
        //obtenemos el nombre del archivo
        $nombre =  time() . "_" . $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        //$test=\Storage::disk('imagenperfil');
        //dd($file);
        \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
        $funcionario->pathImage = $nombre;


        $funcionario->save();
        // Habilitações Literarias 
        $habilitacoes = $request->habilitacoes;
        $funcionario->hab_literarias()->sync($habilitacoes);

        //Documentos entregues
        $documentos = $request->documentos;
        $funcionario->documentos()->sync($documentos);

        //idiomas
        $idiomas = $request->idiomas;
        $funcionario->idiomas()->sync($idiomas);

        return  redirect()->route('indexFuncionarios');
    }


    public function editar($id)
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');
        $subsidios = Subsidio::all();
        $documentos = Documento_funcionario::all();
        $grupos = Grupo_funcionario::all();
        $contratos = Tipo_contrato::all();
        $habilitacoes = Hab_literaria::all();
        $idiomas = Lingua::all();



        $funcionario = Funcionario::find($id);

        return view('funcionarios.editar', compact('provincias', 'municipios', 'date', 'funcionario', 'subsidios', 'documentos', 'grupos', 'contratos', 'habilitacoes', 'idiomas'));
    }

    public function update_funcionario(Request $request)
    {

        $funcionario = Funcionario::find($request->id);

        $funcionario->nome_completo = $request->nome_completo;
        $funcionario->sexo = $request->sexo;
        $funcionario->estado_civil = $request->estado_civil;
        $funcionario->data_nac = $request->data_nac;
        $funcionario->numero_filhos = $request->numero_filhos;
        $funcionario->numero_bi = $request->numero_bi;
        $funcionario->data_emissao_bi = $request->data_emissao_bi;
        $funcionario->data_validade_bi = $request->data_validade_bi;
        $funcionario->nome_pai = $request->nome_pai;
        $funcionario->nome_mae = $request->nome_mae;
        $funcionario->provincia = $request->provincia;
        $funcionario->municipio = $request->municipio;
        $funcionario->nacionalidade = $request->nacionalidade;
        $funcionario->telefone1 = $request->telefone1;
        $funcionario->telefone2 = $request->telefone2;
        $funcionario->provincia_morada = $request->provincia_morada;
        $funcionario->municipio_morada = $request->municipio_morada;
        $funcionario->zona_morada = $request->zona_morada;
        $funcionario->salario_base = $request->salarioBase;
        $funcionario->categoria_prof = $request->categoria_prof;
        $funcionario->tempo_exp_prof = $request->tempo_exp_prof;
        $funcionario->data_admissao = $request->data_admissao;
        $funcionario->tipo_contrato_id = $request->tipo_contrato;
        $funcionario->categoria_ocupacional = $request->categoria_ocupacional;

        $funcionario->grupo_funcionario_id = $request->grupo;


        $file = $request->file('imagenperfil');
        //obtenemos el nombre del archivo
        if ($file != null) {
            $nombre =  time() . "_" . $file->getClientOriginalName();
            File::delete(\Storage::disk('imagenperfil'), $funcionario->pathImage); // Delete
            \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
            $funcionario->pathImage = $nombre;
        }


        $funcionario->save();

        return  redirect()->route('indexFuncionarios');
    }

    public function editar_candidato($id)
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');
        $candidato = Funcionario_Candidato::find($id);
        $documentos = Documento_funcionario::all();

        return view('funcionarios.editar_candidato', compact('provincias', 'municipios', 'date', 'candidato', 'documentos'));
    }


    public function store_candidato(Request $request)
    {

        $candidato = new Funcionario_Candidato();

        $candidato->nome_completo = $request->nome_completo;
        $candidato->sexo = $request->sexo;
        $candidato->estado_civil = $request->estado_civil;
        $candidato->data_nac = $request->data_nac;
        $candidato->numero_filhos = $request->numero_filhos;
        $candidato->numero_bi = $request->numero_bi;
        $candidato->data_emissao_bi = $request->data_emissao_bi;
        $candidato->data_validade_bi = $request->data_validade_bi;
        $candidato->num_contribuinte = $request->num_contribuinte;
        $candidato->num_seguranca_social = $request->num_seguranca_social;
        $candidato->nome_pai = $request->nome_pai;
        $candidato->nome_mae = $request->nome_mae;
        $candidato->provincia = $request->provincia;
        $candidato->municipio = $request->municipio;
        $candidato->nacionalidade = $request->nacionalidade;
        $candidato->telefone1 = $request->telefone1;
        $candidato->telefone2 = $request->telefone2;
        $candidato->provincia_morada = $request->provincia_morada;
        $candidato->municipio_morada = $request->municipio_morada;
        $candidato->zona_morada = $request->zona_morada;

        $candidato->save();

        return  redirect()->route('listarFuncionario_candidato');
    }



    public function update_candidato(Request $request)
    {

        $candidato = Funcionario_Candidato::find($request->candidato_id);

        $candidato->nome_completo = $request->nome_completo;
        $candidato->sexo = $request->sexo;
        $candidato->estado_civil = $request->estado_civil;
        $candidato->data_nac = $request->data_nac;
        $candidato->numero_filhos = $request->numero_filhos;
        $candidato->numero_bi = $request->numero_bi;
        $candidato->data_emissao_bi = $request->data_emissao_bi;
        $candidato->data_validade_bi = $request->data_validade_bi;
        $candidato->num_contribuinte = $request->num_contribuinte;
        $candidato->num_seguranca_social = $request->num_seguranca_social;
        $candidato->nome_pai = $request->nome_pai;
        $candidato->nome_mae = $request->nome_mae;
        $candidato->provincia = $request->provincia;
        $candidato->municipio = $request->municipio;
        $candidato->nacionalidade = $request->nacionalidade;
        $candidato->telefone1 = $request->telefone1;
        $candidato->telefone2 = $request->telefone2;
        $candidato->provincia_morada = $request->provincia_morada;
        $candidato->municipio_morada = $request->municipio_morada;
        $candidato->zona_morada = $request->zona_morada;

        $candidato->save();

        return  redirect()->route('listarFuncionario_candidato');
    }

    public function mapa_ferias()
    {

        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $funcionarios = Funcionario::all();
        return view('funcionarios.ferias_new', compact('funcionarios', 'date'));
    }

    public function editar_ferias($id)
    {

        //  $date = Carbon::now();
        //  $date = $date->format('20y-m-d');
        $feria = Feria::find($id);
        $feria->delete();
        //   $funcionario=Funcionario::find($feria->funcionario_id);
        //  return view('funcionarios.editar_ferias', compact('funcionario','feria', 'date'));
        return redirect()->route('mapa_ferias');
    }

    public function store_feria(Request $request)
    {

        $feria = new Feria();
        $feria->funcionario_id = $request->funcionario_id;
        $feria->data_inicio = $request->data_inicio;
        $feria->data_fim = $request->data_fim;
        $feria->save();

        return redirect()->route('mapa_ferias');
    }

    public function contratar_candidato($id)
    {

        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');
        $subsidios = Subsidio::all();
        $documentos = Documento_funcionario::all();

        $candidato = Funcionario_Candidato::find($id);
        return view('funcionarios.contratar', compact('provincias', 'municipios', 'date', 'subsidios', 'documentos', 'candidato'));
    }

    public function eliminar_candidato($id)
    {
        $candidato = Funcionario_Candidato::find($id);
        $candidato->delete();

        return  redirect()->route('listarFuncionario_candidato');
    }

    public function index_mapas_salarios()
    {
        $mapas = Mapa_salario::all();
        return view('funcionarios.index_mapas_salarios', compact('mapas'));
    }
    public function registrar_mapa_salarios()
    {
        $grupos = Grupo_funcionario::all();
        return view('funcionarios.inserir_mapa', compact('grupos'));
    }
    public function store_mapa_salarios(Request $request)
    {


        $mapa = new Mapa_salario();

        $mapa->titulo = $request->titulo;
        $mapa->mes = $request->mes;
        $mapa->ano = $request->ano;
        $mapa->descricao = $request->descricao;
        $mapa->grupo_funcionario_id = $request->grupo;
        $mapa->save();

        $funcionarios = Funcionario::where('grupo_funcionario_id', $request->grupo)->get();
        foreach ($funcionarios as $funcionario) {
            $temp_salario = new Temp_salario();
            $temp_salario->funcionario_id = $funcionario->id;
            $temp_salario->mapa_salario_id = $mapa->id;
            $temp_salario->save();
        }

        //  return view('funcionarios.mapa_salarios', compact('mapa'));
        return redirect()->route('index_mapas_salarios');
    }

    public function mostrar_mapa($id)
    {
        $mapa = Mapa_salario::find($id);

        return view('funcionarios.mapa_salarios', compact('mapa'));
    }

    public function exportar_mapa($idMapa)
    {
        $mapa = Mapa_salario::find($idMapa);
        $date = Carbon::now();


        $pdf = PDF::loadView('funcionarios.pdfMapaPagamentos', compact(
            'mapa',
            'date'

        ))->setPaper('a4', 'landscape');
        // $pdf->set_paper('A4', 'landscape');
        return $pdf->download('mapa_pagamentos.pdf');
    }

    public  function exportar_mapa_seg_social($mes, $ano)
    {
        //$mapa = Mapa_salario::find($idMapa);
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();
        $date = Carbon::now();

        $pdf = PDF::loadView('funcionarios.pdf_seg_social', compact(
            'mapas',
            'date',
            'mes',
            'ano'

        ))->setPaper('a4', 'landscape');
        // $pdf->set_paper('A4', 'landscape');
        return $pdf->download('mapa_seg_social.pdf');
    }
    public function exportar_mapa_irt($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();

        $date = Carbon::now();

        $pdf = PDF::loadView('funcionarios.pdf_irt', compact(
            'mapas',
            'date',
            'mes',
            'ano'

        ))->setPaper('a4', 'landscape');
        // $pdf->set_paper('A4', 'landscape');
        return $pdf->download('mapa_irt.pdf');
    }

    public function faltasUpdate(Request $request)
    {
        if ($request->ajax()) {
            $temp_salario = Temp_salario::find($request->input('pk'));
            $temp_salario->horas_faltas = $request->input('value');
            $id = $temp_salario->funcionario_id;
            $horas = $request->input('value');
            $desconto = Funcionario::calcular_desconto_faltas($id, $horas);
            $temp_salario->desconto_faltas = $desconto;


            $temp_salario->save();

            return response()->json(['success' => true]);
        }
    }


    public function faltasLoad(Request $request)
    {
        $temp_salario = Temp_salario::find($request->input('pk'));

        return $temp_salario->horas_faltas;
    }

    public function subsidioFuncaoUpdate(Request $request)
    {
        if ($request->ajax()) {
            $temp_salario = Temp_salario::find($request->input('pk'));
            $subsidio = $request->input('value');

            $temp_salario->subcidio_funcao = $subsidio;
            $temp_salario->salario_liquido += $subsidio;


            $temp_salario->save();

            return response()->json(['success' => true]);
        }
    }


    public function subsidioFuncaoLoad(Request $request)
    {
        $temp_salario = Temp_salario::find($request->input('pk'));

        return $temp_salario->subcidio_funcao;
    }

    public function index_grupos_funcionarios()
    {

        $grupos = Grupo_funcionario::all();

        return view('funcionarios.index_grupos_funcionarios', compact('grupos'));
    }
    public function registrar_grupo_funcionario()
    {
        return view('funcionarios.inserir_grupo');
    }

    public function store_grupo_funcionario(Request $request)
    {

        $grupo = new Grupo_funcionario();
        $grupo->nome = $request->nome;
        $grupo->descricao = $request->descricao;

        $grupo->save();

        return  redirect()->route('index_grupos_funcionarios');
    }

    public function editar_grupo_funcionario($id)
    {
        $grupo = Grupo_funcionario::find($id);

        return view('funcionarios.editar_grupo', compact('grupo'));
    }

    public function update_grupo_funcionario(Request $request)
    {

        $grupo = Grupo_funcionario::find($request->id);
        $grupo->nome = $request->nome;
        $grupo->descricao = $request->descricao;

        $grupo->save();
        return  redirect()->route('index_grupos_funcionarios');
    }

    public function eliminar_grupo_funcionario($id)
    {
        $grupo = Grupo_funcionario::find($id);

        $grupo->delete();
        return redirect()->route('index_grupos_funcionarios');
    }

    public function eliminar_funcionario($id)
    {
        $funcionario = Funcionario::find($id);

        $funcionario->delete();

        return  redirect()->route('indexFuncionarios');
    }

    public function index_subsidios(Request $request)
    {
        $listaFuncionarios = Funcionario::pluck('nome_completo', 'id');
        $subsidios = Subsidio::all();
        $id_funcionario = $request->funcionario_subsidio;
        $funcionario = "";
        $lista_subsidios = "";
        if ($id_funcionario != null) {
            $lista_subsidios = "Mostrando lista de subsidios";
            $funcionario = Funcionario::find($id_funcionario);
        }

        return view('funcionarios.index_subsidios', compact('listaFuncionarios', 'lista_subsidios', 'funcionario', 'subsidios'));
    }

    //
    public function eliminar_subsidio($idFuncionario, $idSubsidio)
    {

        $funcionario = Funcionario::find($idFuncionario);
        $funcionario->subsidios()->detach($idSubsidio);
        return redirect()->route('index_subsidios', ["funcionario_subsidio" => $funcionario->id]);
    }

    //
    public function registrar_subsidio(Request $request)
    {


        $id_funcionario = $request->funcionario;
        $id_subsidio = $request->subsidio;
        $valor = $request->valor;

        $funcionario = Funcionario::find($id_funcionario);
        $funcionario->subsidios()->attach($id_subsidio, ['valor' => $valor]);



        return redirect()->route('index_subsidios', ["funcionario_subsidio" => $funcionario->id]);
    }

    public function eliminar_mapa_salarios($id)
    {
        $mapa = Mapa_salario::find($id);

        $temps_salario = Temp_salario::where('mapa_salario_id', $mapa->id)->get();
        foreach ($temps_salario as $temp) {
            $temp->delete();
        }
        $mapa->delete();

        return redirect()->route('index_mapas_salarios');
    }

    public function index_mapas(Request $request)
    {

        $option = $request->tipo;
        $mes = $request->mes;
        $ano = $request->ano;
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();
       // dd($mes,$ano,$mapas);
        $date = Carbon::now();

        if ($option == "irt") {
            // $this->exportar_mapa_irt($mes,$ano);
            $pdf = PDF::loadView('funcionarios.pdf_irt', compact(
                'mapas',
                'date',
                'mes',
                'ano'

            ))->setPaper('a4', 'landscape');
            // $pdf->set_paper('A4', 'landscape');
            return $pdf->download('mapa_irt.pdf');
        }
        if ($option == "seg") {
            $pdf = PDF::loadView('funcionarios.pdf_seg_social', compact(
                'mapas',
                'date',
                'mes',
                'ano'
    
            ))->setPaper('a4', 'landscape');
            // $pdf->set_paper('A4', 'landscape');
            return $pdf->download('mapa_seg_social.pdf');
        }
        if ($option == "resumo") {
            $pdf = PDF::loadView('funcionarios.pdfResumoPagamentos', compact(
                'mapas',
                'date',
                'mes',
                'ano'
    
            ))->setPaper('a4', 'landscape');
            // $pdf->set_paper('A4', 'landscape');
            return $pdf->download('mapa_resumo.pdf');
        }
    }
}
