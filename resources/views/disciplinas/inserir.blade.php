@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Registrar Unidade Curricular</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{route('salvarDisciplinas')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Nome da Unidade Curricular</label>
                                <input class="form-control" type="text" name="nome" value="{{ old('nome') }}" required>
                                <span class="text-danger">{{ $errors->first('nome') }}</span>

                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select id="curso" name="curso" class="form-control">
                                    @foreach($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ano Curricular</label>
                                <select name="ano" class="form-control">
                                    <option value="1º">1º</option>
                                    <option value="2º">2º</option>
                                    <option value="3º">3º</option>
                                    <option value="4º">4º</option>
                                    <option value="5º">5º</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Semestre</label>
                                <select name="semestre" class="form-control">
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nuclear</label>
                                <select name="nuclear" class="form-control">
                                    <option selected value="0">Não</option>
                                    <option value="1">Sim</option>
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
                                                    <input name="T" type="number" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">TP</label>
                                                    <input name="TP" type="number" class="form-control">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">P</label>
                                                    <input name="P" type="number" class="form-control">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">HS</label>
                                                    <input name="HS" type="number" class="form-control">

                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">HSem</label>
                                                    <input name="HSem" type="number" class="form-control">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Unidade Curricular Precedente</label>
                                <select id="precedencia" name="precedencia" class="form-control">

                                    <option value="-" selected>Selecionar</option>
                                    <optgroup id="unidades_curso"label="Unidades Curriculares do curso">
                                        
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Nome do Professor</label>
                                <select id="professorDis" name="professor" class="form-control">
                                    <option value="-" selected>Selecionar</option>
                                    @foreach($professores as $professor)
                                    <option value="{{$professor->id}}">{{$professor->nome}} {{$professor->apelidos}}</option>
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
                            <button class="btn btn-primary btn-block" type="submit">Registrar</button>
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
        $('#professorDis').select2({});
        $("#curso").change(function(event) {

            var id_curso = $(this).val();
            $('#unidades_curso').empty();

            url = "disciplinasCurso/" + id_curso + "";
            $.getJSON(url, function(response, state) {
             
                $.each(response, function(k, v) {
                    $('#unidades_curso').append('<option value=' + v.id + '>' + v.nome + '</option>');
                });
            });
        });
    });
</script>
@endSection


@stop