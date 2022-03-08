@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>
    <form action="{{route('fazerInscricao')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="idEst" value="{{ $estudante->id }}">
        <input type="hidden" name="ano" value="{{ $ano }}">
        <input type="hidden" name="sem" value="{{ $sem }}">
        <input type="hidden" name="anoAcademico" value="{{ $anoAcademico }}">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3> Painel de Inscrição em Unidades Curriculares</h3>
            </div>

            <div class="panel-body">

                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-2">
                                <img width="150px" height="150px" src="{{url('/storage/'.$estudante->pathImage) }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3><b>Estudante:</b> {{$estudante->nome}}&nbsp;&nbsp;&nbsp; <b>Nº:</b>&nbsp;{{$estudante->codigo}}</h3>
                                <h3><b>Curso:</b> {{\App\Curso::toString($estudante->curso_id)}}</h3>
                                <h3><b>Ano Curricular:</b> {{$ano}} <b>&nbsp;&nbsp; Semestre:</b> {{$sem}} <b>&nbsp;&nbsp; Ano Acadêmico:</b> {{$anoAcademico}}</h3>
                            </div>
                        </div>

                    </div>
                </div>

                @if(isset($disciplinasAtrasso))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Unidades Curriculares em Atraso</h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="5px"></th>
                                <th width="5px">Nº</th>
                                <th width="5px">Nome da Unidade Curricular</th>
                            </tr>
                            @foreach($disciplinasAtrasso as $i=>$discAtraso)
                            <tr>
                                <td>
                                    @if(($discAtraso!=null)&&(\App\Disciplina::getSemestre($discAtraso)==$sem))
                                    <input type="checkbox" name="disciplinaAtraso[]" id="disciplinasAtraso" value="{{$discAtraso}}">
                                    @else
                                    @endif
                                </td>
                                <td>{{$i+1}}</td>
                                <td>{{\App\Disciplina::toString($discAtraso)}}</td>
                            </tr>

                            @endforeach
                        </table>



                    </div>
                </div>
                @endif
                @if($sem=="I")
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Turma</h3>
                    </div>
                    <div class="panel-body">
                        <select name="turmaInsc" id="turmaInsc">
                            <option value="-">Seleccione a Turma</option>
                            @foreach($turmas as $turma)
                            <option value="{{$turma->id}}">{{$turma->identificador}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Unidades Curriculares para fazer Inscrição</h3>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="5px"><input type="checkbox" id="checkTodos" name="checkTodos"></th>
                                <th width="5px">Nº</th>
                                <th>Unidade Curricular</th>

                            </tr>
                            @foreach($disciplinas as $i=>$item)
                            <tr>
                                <td>
                                    @if(\App\Disciplina::temPrecedencia($item,$disciplinasAtrasso))
                                    @else
                                    <input type="checkbox" name="disciplina[]" id="disciplinas" value="{{$item->id}}">

                                    @endif
                                </td>
                                <td>{{$i+1}}</td>
                                <td>
                                    @if(\App\Disciplina::temPrecedencia($item,$disciplinasAtrasso))
                                    <p style="color: red;"> {{$item->nome}}</p>
                                    @else
                                    {{$item->nome}}
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </table>
                        <button type="submit" class="btn btn-primary">Registar Inscrição</button>


                    </div>
                </div>



            </div>
        </div>

    </form>

    @section('scripts')
    <script>
        $(document).ready(function() {

            $("#checkTodos").click(function() {
                $('input:checkbox').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    @endsection

    @stop