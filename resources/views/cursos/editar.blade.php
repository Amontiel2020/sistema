@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Actualizar Curso</h3>
    </div>
    <div class="panel-body">


        <form role="form" action="{{route('actualizarCurso')}}" id="createDepartamento_form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $curso->id }}">

            <div class="form-group">
                <label>Nome do Curso</label>
                <input class="form-control" type="text" name="nome" value="{{$curso->nome}}" required>
            </div>

            <div class="form-group">
                <label>Abreviatura</label>
                <input class="form-control" type="text" name="codigo" value="{{$curso->codigo}}" required>
            </div>
            <div class="form-group">
                <label>Duração Curricular (anos)</label>
                <input class="form-control" type="text" name="duracao" value="{{$curso->duracao}}" required>
            </div>

            <div class="form-group">
                <label>Secção de Aulas</label>
                <select name="seccao" id="seccao" class="form-control">
                    @foreach($seccoes as $seccao)
                    <option @if($curso->seccao_id==$seccao->id) selected @endif value="{{$seccao->id}}">{{$seccao->nome}}</option>
                    @endforeach
                </select>
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
    if ($("#createDepartamento_form").length > 0) {
        $('#createDepartamento_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");

        $("#createDepartamento_form").validate({

            rules: {
                identificador: {
                    required: true,
                    maxlength: 50,
                },


            },
            messages: {

                identificador: {
                    required: "É obrigatória a indicação de um valor para o campo identificador.",
                }

            },
        })
    }
</script>
@endSection



@stop