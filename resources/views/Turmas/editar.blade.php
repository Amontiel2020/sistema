@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Turmas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Turmas
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('updateTurmas',$turma->id)}}" id="createTurma_form" method="PUT">

                            <div class="form-group">
                                <label>Identificador</label>
                                <input class="form-control" type="text" name="identificador" value="{{$turma->identificador}}" required>
                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select name="curso" id="curso" class="form-control">
                                    @foreach($cursos as $curso)
                                    <option @if($curso->id==$turma->curso_id) selected @endif value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ano Curricular</label>
                                <select name="anoLectivo" id="anoLectivo" class="form-control">
                                    <option @if($turma->anoLectivo==1) selected @endif value=1>1</option>
                                    <option @if($turma->anoLectivo==2) selected @endif value=2>2</option>
                                    <option @if($turma->anoLectivo==3) selected @endif value=3>3</option>
                                    <option @if($turma->anoLectivo==4) selected @endif value=4>4</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Periodo</label>
                                <select name="periodo" id="periodo" class="form-control">
                                    <option @if($turma->periodo=="M") selected @endif value="M">Manhã</option>
                                    <option @if($turma->periodo=="T") selected @endif value="T">Tarde</option>
                                    <option @if($turma->periodo=="NULL") selected @endif value="N">Noite</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ano Acadêmico</label>
                                <select name="anoAcademico" id="anoAcademico" class="form-control">
                                    <option @if($turma->anoAcademico==2020) selected @endif value="2020">2020</option>
                                    <option @if($turma->anoAcademico==2021) selected @endif  value="2021">2021</option>
                                    <option @if($turma->anoAcademico==2022) selected @endif value="2022">2022</option>
                                    <option @if($turma->anoAcademico==2023) selected @endif value="2023">2023</option>
                                    <option @if($turma->anoAcademico==2024) selected @endif value="2024">2024</option>
                                    <option @if($turma->anoAcademico==2025) selected @endif value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
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
    if ($("#createTurma_form").length > 0) {
        $('#createTurma_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");

        $("#createTurma_form").validate({

            rules: {
                identificador: {
                    required: true,
                    maxlength: 50,
                },

                curso: {
                    required: true,
                    maxlength: 50,

                },

                periodo: {
                    required: true,
                    maxlength: 50,
                },
            },
            messages: {

                identificador: {
                    required: "É obrigatória a indicação de um valor para o campo identificador.",
                },
                curso: {
                    required: "É obrigatória a indicação de um valor para o campo curso.",
                },
                periodo: {
                    required: "É obrigatória a indicação de um valor para o campo periodo.",
                    maxlength: "maximo permitido 50",
                },

            },
        })
    }
</script>
@endSection


@stop