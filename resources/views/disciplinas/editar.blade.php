@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Unidade Curricular </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{route('updateDisciplinas')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $disciplina->id }}">

                            <div class="form-group">
                                <label>Nome da Unidade Curricular</label>
                                <input class="form-control" type="text" name="nome" value="{{ $disciplina->nome }}" required>
                                <span class="text-danger">{{ $errors->first('nome') }}</span>

                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select id="cursoEdit" name="curso" class="form-control">
                                    @foreach($cursos as $curso)
                                    <option @if($curso->id == $disciplina->curso_id) selected @endif value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ano Curricular</label>
                                <select name="ano" class="form-control">
                                    <option @if($disciplina->ano == "1º") selected @endif value="1º">1º</option>
                                    <option @if($disciplina->ano == "2º") selected @endif value="2º">2º</option>
                                    <option @if($disciplina->ano == "3º") selected @endif value="3º">3º</option>
                                    <option @if($disciplina->ano == "4º") selected @endif value="4º">4º</option>
                                    <option @if($disciplina->ano == "5º") selected @endif value="5º">5º</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Semestre</label>
                                <select name="semestre" class="form-control">
                                    <option @if($disciplina->semestre == "I") selected @endif value="I">I</option>
                                    <option @if($disciplina->semestre == "II") selected @endif value="II">II</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nuclear</label>
                                <select name="nuclear" class="form-control">
                                    <option @if($disciplina->nuclear == "0") selected @endif value="0">Não</option>
                                    <option @if($disciplina->nuclear == "1") selected @endif value="1">Sim</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <h5 class="text-center">Horas</h5>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="">T</label>
                                                    <input name="T" type="number" class="form-control" value="{{ $disciplina->T }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">TP</label>
                                                    <input name="TP" type="number" class="form-control" value="{{ $disciplina->TP }}">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">P</label>
                                                    <input name="P" type="number" class="form-control" value="{{ $disciplina->P }}">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">HS</label>
                                                    <input name="HS" type="number" class="form-control" value="{{ $disciplina->HS }}">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">HSem</label>
                                                    <input name="HSem" type="number" class="form-control" value="{{ $disciplina->HSem }}">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--    <div class="form-group">
                                <label>Unidade Curricular Precedente</label>
                                <select name="precedencia" class="form-control">
                                    <option value="-">Selecionar</option>
                                    <optgroup id="unidades_curso2" label="Unidades Curriculares do curso">

                                    </optgroup>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label> Nome do Professor</label>

                                <select id="professorDisEdit" name="professor" class="form-control">
                                    <option value="-">Selecionar</option>

                                    @foreach($professores as $professor)
                                    <option @if($professor->id == $disciplina->professor_id) selected @endif value="{{$professor->id}}">{{$professor->nome}} {{$professor->apelidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-12">

                        <div class="col-lg-6">
                            <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-outline btn-success btn-block">Cancelar</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</form>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#professorDisEdit').select2({});
        $("#cursoEdit").change(function(event) {
            // alert('OK');
            var id_curso = $(this).val();
            alert(id_curso);
            $('#unidades_curso2').empty();

            url = "/disciplinasCurso/" + id_curso + "";
            $.getJSON(url, function(response, state) {


                $.each(response, function(k, v) {
                    $('#unidades_curso2').append('<option value=' + v.id + '>' + v.nome + '</option>');
                });
            });
        });
    });
</script>
@endSection


@stop