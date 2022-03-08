@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">

        </div>

        <div class="panel-body">
            <form action="#">
                <div class="row">
                    <!--  <div class=col-md-4>
                        <select name="tipo" class="form-control">
                            <option>Pesquisar por tipo</option>
                            <option>nome</option>
                            <option>apelido</option>
                            <option>curso</option>
                            <option>email</option>
                            <option>turma</option>
                        </select>
                    </div>
                    -->
                    <div class=col-md-4>
                        <input type="text" class="form-control" name="buscarpor" value="" placeholder="Nome">
                    </div>
                    <div class=col-md-4>

                        <button type="submit" class="btn btn-primary" title="Pesquisar">
                            Pesquisar
                        </button>
                    </div>
                </div>

            </form>
            <br>





        </div>
    </div>
 
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-left">
                        <div class="huge"></div>
                        <div>
                            <h1> Processo de Candidatura de {{$item->ano}}</h1>
                        </div>
                    </div>

                </div>

            </div>


            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Cursos com Candidaturas Abertas</h3>

                </div>

                <!--     @foreach($item->cursos as $curso)
                    <div>
                        <span class="pull-right"><i class="fa fa-minus"></i></span>
                    </div>
                    <a href="{{route('deleteCursoCandidatura',[$item->id,$curso->id])}}"><span class="pull-left">{{$curso->nome}}</span></a>

                    <div class="clearfix"></div>

                    @endforeach -->
                <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <th>Curso</th>
                        <th>Valor Inscrição</th>
                        <th></th>
                    </tr>
                    @foreach($item->cursos as $curso)
                    <tr>
                        <td>{{$curso->nome}} </td>
                        <td>
                            {{$valorInsc}}

                        </td>
                        <td> <a href="{{route('deleteCursoCandidatura',[$item->id,$curso->id])}}"><label class="label label-danger">Eliminar</label></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>




            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Cursos sem Candidaturas Abertas</h3>

                </div>
                <div class="panel-body">
                    @if($cursos !=null)
                    @foreach($cursos as $curso)
                    @if(!$item->esta($curso->id,$item->cursos))
                    <span class="pull-left">{{$curso->nome}} </span>
                    <a href="{{route('addCursoCandidatura',[$item->id,$curso->id])}}"><span class="pull-right"><i class="fa fa-plus"></i></span><label class="label label-success">adicionar</label></a>
                    <div class="clearfix"></div>
                    @endif

                    @endforeach
                    @else
                    Todos os cursos foram incluidos
                    @endif
                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Candidatos</h3>
                </div>
                <div class="panel-body">
                    <a href="{{route('indexCandidatos',$item->id)}}">Registrar Candidato</a><br>
                    <a href="{{route('listarCandidatos',$item->id)}}">Listagem Candidatos</a><br>
                    <a href="{{route('listarInscritos',$item->id)}}">Listagem Inscritos</a><br>
                    <a href="{{route('resultadosProcesso',$item->id)}}">Resultados do processo</a><br>
                    <a href="{{route('indexMatriculas',$item->id)}}">Candidatos Aprovados</a><br>
                    <a href="{{route('resultadosCandidatos')}}">Pauta Resultados</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Exames de Admissão</h3>
                </div>
                <div class="panel-body">
                <div class="row">
                        <div class="col-md-4">
                            <h3> <span>Valor do corte</span>
                                <a href="#" class="editCorte" data-pk="{{$item->id}}" data-name="valorDeCorte">
                                    {{$item->valorDeCorte}}</a>
                            </h3>

                        </div>
                        <div class="col-md-6">
                            <form id="addExame" action="{{route('addExameToProcesso')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="processo_id" value="{{ $item->id }}">

                                <button type="submit" class="btn btn-success btn-sm pull-right">Registrar Exame</button>
                                <input type="text" name="nome" class="pull-right" placeholder="Nome do Exame" />
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th>Disciplina</th>
                            <th></th>
                        </tr>
                        @foreach($item->exames as $exame)
                        <tr>
                            <td> <a href="#" class="editExame" data-pk="{{$exame->id}}" data-name="nome">
                                    {{$exame->nome}}</a></td>
                            <td> <a href="#"><label class="label label-danger">Eliminar</label></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>





            <!--
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Exames de Admissão</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3> <span>Valor do corte</span>
                                <a href="#" class="editCorte" data-pk="{{$item->id}}" data-name="valorDeCorte">
                                    {{$item->valorDeCorte}}</a>
                            </h3>

                        </div>
                        <div class="col-md-6">
                            <form id="addExame" action="{{route('addExameToProcesso')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="processo_id" value="{{ $item->id }}">

                                <button type="submit" class="btn btn-success btn-sm pull-right">Registrar Exame</button>
                                <input type="text" name="nome" class="pull-right" placeholder="Nome do Exame" />
                            </form>
                        </div>
                    </div>


                    @foreach($item->exames as $exame)
                    <div class="row">
                        <div class="col-md-12">
                         


                            <h3> <a href="#" class="editExame" data-pk="{{$exame->id}}" data-name="nome">
                                    {{$exame->nome}}</a></h3>
                        </div>
                    </div>

                    <div class="row">
                        <form action="{{route('addCursoToExameCandidatura')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="exame_id" value="{{ $exame->id }}">
                            <div class="col-md-4">
                                <select name="curso_id" id="cursosToExame">
                                    <option value="-">Curso</option>
                                    @foreach($item->cursos as $curso)
                                    <option @if($exame->esta($curso->id,$exame->cursos)) disabled @endif value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach

                                </select>
                                <select name="professorExame" id="">
                                    <option value="-">Professor</option>
                                    @foreach($professores as $professor)
                                    <option value="{{$professor->id}}">{{$professor->nome}} {{$professor->apelido}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">

                                <button type="submit" class="btn btn-success btn-sm"><span class="pull-left">>>></span></button>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <table class="table table-bordered table-striped table-condensed">
                                <tr>
                                    <th>Curso</th>
                                    <th>Peso</th>
                                    <td>Professor</td>
                                    <th>Pauta</th>
                                    <td></td>
                                </tr>
                                @foreach($exame->cursos as $cursoExame)
                                <tr>
                                    <td>{{$cursoExame->nome}}</td>
                                    <td>
                                        <a href="#" class="editPeso" data-pk="{{$exame->id}}" data-name="{{$cursoExame->id}}">
                                            {{$cursoExame->pivot->peso}}</a>
                                    </td>
                                    <td>
                                        <a href="#" data-type="select" data-value="nome" class="editable-select" data-pk="{{$exame->id}}" data-name="{{$cursoExame->id}}">{{\App\Professor::toString($cursoExame->pivot->professor_id)}} </a>
                                      
                                    </td>
                                    <td>
                                        @if(!$item->existePauta($item->id,$exame->id,$cursoExame->id))
                                        <a href="{{route('criarPautaExameCandidatura',[$item->id,$exame->id,$cursoExame->pivot->professor_id,$cursoExame->id])}}">Criar</a>
                                        @endif

                                        @if($item->existePauta($item->id,$exame->id,$cursoExame->id))
                                        <a href="{{route('listarPautaExameCandidatura',[$item->id,$exame->id,$cursoExame->id])}}">Ver</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$item->existePauta($item->id,$exame->id,$cursoExame->id))
                                        <a href="{{route('deleteCursoToExameCandidatura',[$exame->id,$cursoExame->id])}}"><span class="pull-left"><label class="label label-danger">Eliminar</label></span></a>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>



                    <div class="clearfix"></div>
                    @endforeach
                </div>

            </div>
-->

            <!---**********************************************************************************************************************---->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Exames de Admissão por Curso</h3>
                </div>
                <div class="panel-body">
                    @foreach($item->cursos as $curso)
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{$curso->nome}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-condensed">
                                <tr>
                                    <th>Disciplina</th>
                                    <th>Peso</th>
                                    <td>Professor</td>
                                    <th>Pauta</th>
                                    <td></td>
                                </tr>
                            
                               @foreach(\App\ExameCandidatura::listaExamesCurso($item->id) as $cursoExame)
                                <tr>
                                    <td>
                                      
                                        {{$cursoExame->nome}}


                                    </td>
                                    <td>
                                        <a href="#" class="editPeso" data-pk="{{$cursoExame->id}}" data-name="{{$curso->id}}">
                                            {{\App\ExameCandidatura::obter_peso($cursoExame->id,$curso->id)}}</a>
                                    </td>
                                    <td>
                                        <a href="#" data-type="select" class="editProfessor" data-pk="{{$cursoExame->id}}" data-name="{{$curso->id}}"> {{\App\ExameCandidatura::obter_profe($cursoExame->id,$curso->id)}} </a>
                                       
                                    </td>
                                    <td>
                                        @if(!$item->existePauta($item->id,$cursoExame->id,$curso->id))
                                        <a role="button" class="btn btn-danger btn-xs" href="{{route('criarPautaExameCandidatura',[$item->id,$cursoExame->id,$cursoExame->professor_id,$curso->id])}}">Criar</a>
                                        @endif

                                        @if($item->existePauta($item->id,$cursoExame->id,$curso->id))
                                        <a  role="button" class="btn btn-success btn-xs" href="{{route('listarPautaExameCandidatura',[$item->id,$cursoExame->id,$curso->id])}}">Ver</a>
                                        @endif
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td> <a href="#" data-type="select" data-value="nome" data-pk="{{$curso->id}}" class="editable-selectExame"> </a></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @endforeach
                </div>
            </div>
            <!---**********************************************************************************************************************---->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Documentos incluidos no processo de candidatura</h3>

                </div>

                <div class="panel-body">
                    <form action="{{route('addDocumento')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success btn-sm pull-right">Registrar</button>
                        <input type="text" name="nome" class="pull-right" placeholder="Nome do documento" />
                    </form>

                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                        @foreach($item->documentos as $documento)
                        <tr>
                            <td>{{$documento->nome}}</td>
                            <td>{{$documento->descricao}}</td>
                            <td> <a href="{{route('deleteDocumentoToProcesso',[$documento->id,$item->id])}}"> <label class="label label-danger">Eliminar</label></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class=" panel panel-default">
                <div class="panel-heading">
                    <h3>Documentos não incluidos no processo de candidatura</h3>
                </div>
                <!--    @foreach($documentos as $documento)
                @if(!$item->estaDocumento($documento->id,$item->documentos))
                <span class="pull-left">{{$documento->nome}}</span>
                <a href="{{route('editarDocumento',[$documento->id])}}"> <label class="label label-success">Editar</label></a>
                <a href="{{route('addDocumentoToProcesso',[$documento->id,$item->id])}}"> <label class="label label-success">adicionar</label></a>
                @endif

                <div class="clearfix"></div>
                @endforeach  -->
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <td>Nome </td>
                            <td>Descrição</td>
                            <td></td>
                        </tr>
                        @foreach($documentos as $row)
                        @if(!$item->estaDocumento($row->id,$item->documentos))
                        <tr>
                            <td>
                                <a href="#" class="xedit" data-pk="{{$row->id}}" data-name="nome">
                                    {{$row->nome}}</a>
                            </td>

                            <td>
                                <a href="#" class="xedit" data-pk="{{$row->id}}" data-name="descricao">
                                    {{$row->descricao}}</a>
                            </td>
                            <td>
                                <a href="{{route('addDocumentoToProcesso',[$row->id,$item->id])}}"> <label class="label label-success">adicionar</label></a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <!--   <div class="panel-default">
                <div class="panel-heading">
                    <h3>Informação para o Candidato</h3>
                </div>
                <div class="panel-body">
                    <textarea class="description" name="description"></textarea>
                </div>
            </div> -->
        </div>
    
        @section('scripts')
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script>
            //actualiza documentos do processo
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });

                $('.xedit').editable({
                    url: '{{url("documentos/update")}}',
                    title: 'Actualizar',
                    success: function(response, newValue) {
                        console.log('Updated', response)
                    }
                });

            });
            //actualizar corte avaliativo
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });

                $('.editCorte').editable({
                    url: '{{url("corte/update")}}',
                    title: 'Actualizar',
                    success: function(response, newValue) {
                        console.log('Updated', response)
                    }
                });
                $('.editExame').editable({
                    url: '{{url("exame/update")}}',
                    title: 'Actualizar',
                    success: function(response, newValue) {
                        console.log('Updated', response)
                    }
                });
                $('.editPeso').editable({
                    url: '{{url("peso/update")}}',
                    title: 'Actualizar',
                    validate: function(value) {
                        if ($.isNumeric(value) == '') {
                            return 'somente numeros são permitidos';
                        }
                    },
                    success: function(response, newValue) {
                        console.log('Updated', response)
                        if (response.success == true) {
                            alert('OK');
                        }
                        if (response.success == false) {
                            alert('Peso não permitido');
                            die();
                        }

                    },

                    error: function(e) {
                        console.log(e);
                        return;
                    }
                });

                $('.editProfessor').editable({
                    url: '{{url("prof/update")}}',
                    source: '{{url("prof/load")}}',
                    type: 'select',
                    emptytext: 'Definir professor',
                    params: function(params) {
                        //originally params contain pk, name and value
                        params['X-CSRF-TOKEN'] = '{{csrf_token()}}';
                        return params;
                    }

                });


                $('.editable-selectExame').editable({
                    url: '{{url("cursoExame/update")}}',
                    source: '{{url("exame/load")}}',
                    type: 'select',
                    emptytext: 'Adicionar exame',
                    params: function(params) {
                        //originally params contain pk, name and value
                        params['X-CSRF-TOKEN'] = '{{csrf_token()}}';
                        return params;
                    },


                });

            });
        </script>

        <!-- <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script> -->
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: 'textarea.description',
                width: 1024,
                height: 300,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                $("#addExame").validate({

                    rules: {
                        nome: {
                            /*  required: true,*/
                            maxlength: 50,
                            //lettersonly: true 
                        },



                    },
                    messages: {

                        nome: {
                            maxlength: "O nome do exame não pode passar de 50 caracteres.",
                        },

                    },
                })

            });
        </script>
        @endSection

        @stop