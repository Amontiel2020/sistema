@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Registrar Pauta</h3>
    </div>
    <div class="panel-body">


        <!--  <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" type="text" name="nome" value="{{ old('nome') }}" required>
                                <span class="text-danger">{{ $errors->first('nome') }}</span>

                            </div> -->
        <form action="{{route('storePauta')}}" class="form-inline" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
                <div class="col-md-3">
                    <label>Turma</label>
                    <select id="turma" name="turma" class="form-control">
                        @foreach($turmas as $turma)
                        <option value="{{$turma->id}}">{{$turma->identificador}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Ano Curricular</label>
                    <select id="ano" name="anoCurricular" class="form-control">
                        <option value="1">1º</option>
                        <option value="2">2º</option>
                        <option value="3">3º</option>
                        <option value="4">4º</option>
                        <option value="5">5º</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Semestre</label>
                    <select id="sem" name="semestre" class="form-control">
                        <option value="I">I</option>
                        <option value="II">II</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Ano Acadêmico</label>
                    <select name="anoAcademico" class="form-control">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>Unidade Curricular</label>
                    <select id="disciplina" name="disciplina" class="form-control">
                        @foreach($disciplinas as $disciplina)
                        <option value="{{$disciplina->id}}">{{$disciplina->nome}} -{{\App\Curso::toString($disciplina->curso_id)}}</option>
                        @endforeach
                    </select>
                </div>
                <!--    <div class="col-md-6">
                        <label>Professor</label>
                        <select id="professor" name="professor" class="form-control">
                            @foreach($professores as $professor)
                            <option value="{{$professor->id}}">{{$professor->nome}} {{$professor->apelidos}}</option>
                            @endforeach
                        </select>
                    </div>-->
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
        </form>
    </div>
</div>






@section('scripts')
<script>
    $(document).ready(function() {
        $("#turma").change(function(event) {
            // alert('OK')
            var id_turma = $(this).val();
            var ano = $("#ano").val();
            var sem = $("#sem").val();
            url = "disciplinas/" + id_turma + "/" + ano + "/" + sem + "";
            $.getJSON(url, function(response, state) {
                $('#disciplina').empty();
                $.each(response, function(k, v) {
                    $('#disciplina').append('<option value=' + v.id + '>' + v.nome + '</option>');
                });
            });
        });
        $("#ano").change(function(event) {
            // alert('OK')
            var id_turma = $("#turma").val();
            var ano = $(this).val();
            var sem = $("#sem").val();
            url = "disciplinas/" + id_turma + "/" + ano + "/" + sem + "";
            $.getJSON(url, function(response, state) {
                $('#disciplina').empty();
                $.each(response, function(k, v) {
                    $('#disciplina').append('<option value=' + v.id + '>' + v.nome + '</option>');
                });
            });
        });
        $("#sem").change(function(event) {
            // alert('OK')
            var id_turma = $("#turma").val();
            var ano = $("#ano").val();
            var sem = $(this).val();
            url = "disciplinas/" + id_turma + "/" + ano + "/" + sem + "";
            $.getJSON(url, function(response, state) {
                $('#disciplina').empty();
                $.each(response, function(k, v) {
                    $('#disciplina').append('<option value=' + v.id + '>' + v.nome + '</option>');
                });
            });
        });

        /*    $("#disciplina").change(function(event) {
               // alert('OK')
                var id_disciplina = $(this).val();
             //   var ano = $("#ano").val();
             //   var sem = $("#sem").val();
                url = "obterProfessor/" + id_disciplina + "";
                $.getJSON(url, function(response, state) {
                    $('#professor').empty();
                    $.each(response, function(k, v) {
                        alert(v.id);
                        $('#professor').append('<option value=' + v.id + '>' + v.nome + '</option>');
                    });
                });
            });*/


    });
</script>
@endSection


@stop