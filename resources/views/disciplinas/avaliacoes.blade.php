@extends('layouts.Main')

@section('content')

<div class="row">
    <!--  <div class="col-xs-12" align="center">

        <img width="100px" height="100px" src="{{url('/storage/'.'logo.png') }}">

      

        <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
        <p><b> Decreto Presidencial nº 168/12 de 24 de Julho</b></p>
        <p><b>Bairro da Graça, Benguela - A n g o l a</b></p>

    </div>-->



</div>
<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{route('obterInscricoes')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="idDisc" value="{{$idDisc}}">
            <input type="hidden" name="anoAcademico" value="{{\App\CONFIGURACAO::getAnoAcademico()}}">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">


                        <select name="turma" id="turma" class="form-control">
                            @foreach($turmas as $turma)
                            <option value="{{$turma->id}}">{{$turma->identificador}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<form action="{{route('gerarPdfPauta')}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="idDisc" value="{{ $idDisc }}">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Avaliações dos estudantes inscritos em {{\App\Disciplina::toString($idDisc)}} no ano acadêmico {{\App\CONFIGURACAO::getAnoAcademico()}}</h4>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form action="">
                        <div align="rigth">
                            <button type="submit" class="btn btn-primary">Gerar Pauta</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Pautas Geradas</h3>
                </div>
                <div class="panel-body">
                    <!--  "pautas/" . \App\CONFIGURACAO::getAnoAcademico() . "/" . $pauta->curso_id . "/" . $pauta->ano . "/" . $pauta->semestre . "/" -->

                    <ol>

                        @foreach($pautas as $pauta)
                        <li>
                            <a href="{{url('/storage/'.$pauta->id.'_'.$idDisc.'.pdf') }}">{{$pauta->id.'_'.$idDisc}}</a>

                        </li>
                        @endforeach  
                    </ol>
                </div>
            </div>
           
            @if(Auth::user()->hasRole('gestorAreaAcademica'))
            @if(!$estudantes->isEmpty())
            <table class="table table-bordered table-striped">
                <tr>
                    <th colspan="2"></th>
                    <th colspan="3">Frequências</th>
                    <th></th>
                    <th colspan="3">EXAMES</th>
                    <th colspan="2">Resultado da média final</th>
                </tr>
                <tr>
                    <th><input type="checkbox" id="checkTodos" name="checkTodos"></th>
                    <td>Nº</td>
                    <th>Nome do Aluno</th>
                    <th>F1</th>
                    <th>F2</th>
                    <th>MAC</th>
                    <th>M</th>
                    <th>EX1</th>
                    <th>EX2</th>
                    <th>EX3</th>
                    <th>MF</th>
                    <th>Resultado</th>
                </tr>


                @foreach($estudantes as $item)
                 @if($item != null)
                <tr>
                    <td>
                        <input type="checkbox" name="ids[]" value="{{$item->id}}"></td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nome}} </td>
                    <td>
                       
                         
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        
                    </td>
                    <td>
                      
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        
                    </td>
                    <td>
                       
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        
                    </td>
                    <td>
                    {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}
                     
                    </td>


                    <!----------------------------------BLOCO UNIDADE CURRICULAR NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->

                    @if( (\App\Disciplina::isNuclear($idDisc)))
                    <td>

                       
                        @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif

                        

                    </td>
                    <td>
                        @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) 
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif   
                        
                            @endif
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                            @endif
                    </td>
                    <td>
                        @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) 
                        @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif   
                       
                            @endif
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                            @endif
                    </td>
                    <td>
                        {{round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                    </td>
                    <!--  {{\App\Pauta::obterResultadoEstudante($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())}}-->
                    <td>
                        @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())>=10))
                        <span class="label label-success"> Aprovado</span>
                        @endif
                        @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())< 10)) <span class="label label-danger"> Reprovado</span>
                            @endif
                    </td>
                    @endif
                    <!----------------------------------FIM BLOCO UNIDADE CURRICULAR NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->


                    <!----------------------------------BLOCO UNIDADE CURRICULAR NÃO NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->

                    @if( !(\App\Disciplina::isNuclear($idDisc)))

                    <!----------------------------------Não dispensado -->

                    @if(round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<14) 
                    <td>
                       
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                      

                        </td>
                        <td>
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) <10) 
                               @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                               @endif
                               
                                @endif
                                @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                                @endif

                                @endif

                        </td>
                        <td>
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) 

                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                              {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                            @endif
                               
                                @endif
                                @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)>=10)


                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif

                                @endif
                        </td>
                        <td>
                            {{round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                       
                        <td>
                            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())>=10))
                            <span class="label label-success"> Aprovado</span>
                            @endif
                            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())< 10)) <span class="label label-danger"> Reprovado</span>
                                @endif
                        </td>
                        @endif
                        <!----------------------------------fim Não dispensado -->

                        <!----------------------------------dispensado -->

                        @if(round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)>=14)
                        <td>
                            {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                       
                        <td>

                            <span class="label label-success"> Aprovado</span>

                        </td>
                        @endif
                        <!----------------------------------fim  dispensado -->


                        @endif
                        <!----------------------------------FIM BLOCO UNIDADE CURRICULAR NÃO NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->


                </tr>
                  @endif
                @endforeach

            </table>
            @endif
         
            @endif

            @if(!$estudantes->isEmpty())
            <table class="table table-bordered table-striped">
                <tr>
                    <th colspan="2"></th>
                    <th colspan="3">Frequências</th>
                    <th></th>
                    <th colspan="3">EXAMES</th>
                    <th colspan="2">Resultado da média final</th>
                </tr>
                <tr>
                    <th><input type="checkbox" id="checkTodos" name="checkTodos"></th>
                    <td>Nº</td>
                    <th>Nome do Aluno</th>
                    <th>F1</th>
                    <th>F2</th>
                    <th>MAC</th>
                    <th>M</th>
                    <th>EX1</th>
                    <th>EX2</th>
                    <th>EX3</th>
                    <th>MF</th>
                    <th>Resultado</th>
                </tr>


                @foreach($estudantes as $item)
                @if($item!=null)
               
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{$item->id}}"></td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nome}} </td>
                    <td>
                        <a href="#" class="editAvalF1" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                         
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        </a>
                    </td>
                    <td>
                        <a href="#" class="editAvalF2" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        </a>
                    </td>
                    <td>
                        <a href="#" class="editAvalMAC" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        </a>
                    </td>
                    <td>
                    {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}
                     
                    </td>


                    <!----------------------------------BLOCO UNIDADE CURRICULAR NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->

                    @if( (\App\Disciplina::isNuclear($idDisc)))
                    <td>

                        <a href="#" class="editAvalEx1" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                        @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif

                        </a>

                    </td>
                    <td>
                        @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) <a href="#" class="editAvalEx2" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif   
                        </a>
                            @endif
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                            @endif
                    </td>
                    <td>
                        @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) <a href="#" class="editAvalEx3" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                        @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif   
                        </a>
                            @endif
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)
                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                            @endif
                    </td>
                    <td>
                        {{round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                    </td>
                    <!--  {{\App\Pauta::obterResultadoEstudante($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())}}-->
                    <td>
                        @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())>=10))
                        <span class="label label-success"> Aprovado</span>
                        @endif
                        @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())< 10)) <span class="label label-danger"> Reprovado</span>
                            @endif
                    </td>
                    @endif
                    <!----------------------------------FIM BLOCO UNIDADE CURRICULAR NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->


                    <!----------------------------------BLOCO UNIDADE CURRICULAR NÃO NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->

                    @if( !(\App\Disciplina::isNuclear($idDisc)))

                    <!----------------------------------Não dispensado -->

                    @if(round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<14) 
                    <td>
                        <a href="#" class="editAvalEx1" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                           @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif
                        </a>

                        </td>
                        <td>
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) <10) <a href="#" class="editAvalEx2" data-pk="{{$item->id}}" data-name="{{$idDisc}}">
                               @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                               @endif
                                </a>
                                @endif
                                @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP) >=10)

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico())!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                                @endif

                                @endif

                        </td>
                        <td>
                            @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)<10) <a href="#" class="editAvalEx3" data-pk="{{$item->id}}" data-name="{{$idDisc}}">

                            @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                              {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                            @endif
                                </a>
                                @endif
                                @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)>=10)


                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico())!="")
                           {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",\App\CONFIGURACAO::getAnoAcademico()),1)}}
                           @endif

                                @endif
                        </td>
                        <td>
                            {{round(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                       
                        <td>
                            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())>=10))
                            <span class="label label-success"> Aprovado</span>
                            @endif
                            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico())< 10)) <span class="label label-danger"> Reprovado</span>
                                @endif
                        </td>
                        @endif
                        <!----------------------------------fim Não dispensado -->

                        <!----------------------------------dispensado -->

                        @if(round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)>=14)
                        <td>
                            {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            {{round(\App\Pauta::obterMedia($item->id,$idDisc,\App\CONFIGURACAO::getAnoAcademico()), 0, PHP_ROUND_HALF_UP)}}


                        </td>
                       
                        <td>

                            <span class="label label-success"> Aprovado</span>

                        </td>
                        @endif
                        <!----------------------------------fim  dispensado -->


                        @endif
                        <!----------------------------------FIM BLOCO UNIDADE CURRICULAR NÃO NUCLEAR -------------------------------------------------------------------------------------------------------------------------------------------->


                </tr>
                  @endif
                @endforeach

            </table>
          @endif
        
        </div>
    </div>
</form>






@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $.fn.editable.defaults.ajaxOptions = {
            type: "GET"
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.editAvalF1').editable({
            url: '{{url("avalF1/update")}}',
            source: '{{url("avalF1/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalF2').editable({
            url: '{{url("avalF2/update")}}',
            source: '{{url("avalF2/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        /*      $('.editAvalF3').editable({
                  url: '{{url("avalF3/update")}}',
                  source: '{{url("avalF3/load")}}',
                   type: 'text',
                  emptytext: 'Nota',
                  success: function(response, newValue) {
                      console.log('Updated', response)
                  }

              });*/

        $('.editAvalEx1').editable({
            url: '{{url("avalEx1/update")}}',
            source: '{{url("avalEx1/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalEx2').editable({
            url: '{{url("avalEx2/update")}}',
            source: '{{url("avalEx2/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalEx3').editable({
            url: '{{url("avalEx3/update")}}',
            source: '{{url("avalEx3/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalMAC').editable({
            url: '{{url("avalMAC/update")}}',
            source: '{{url("avalMAC/load")}}',
            type: 'text',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $("#checkTodos").click(function() {
            $('input:checkbox').prop('checked', $(this).prop('checked'));
        });

    });
</script>
@endsection
@stop