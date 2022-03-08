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
                <h3>Registrar Mapa</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{route('store_mapa_salarios')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Titulo do Mapa</label>
                                <input class="form-control" type="text" name="titulo" value="{{ old('nome') }}" required>
                                <span class="text-danger">{{ $errors->first('nome') }}</span>

                            </div>


                            <div class="form-group">
                                <label>Mês</label>
                                <select name="mes" class="form-control">
                                    <option value="1">Janeiro</option>
                                    <option value="2">Fevereiro</option>
                                    <option value="3">Março</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Maio</option>
                                    <option value="6">Junho</option>
                                    <option value="7">Julho</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Setembro</option>
                                    <option value="10">Outubro</option>
                                    <option value="11">Novembro</option>
                                    <option value="12">Dezembro</option>


                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ano</label>
                                <select name="ano" class="form-control">
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Grupo de Funcionarios</label>
                                <select id="grupo" name="grupo" class="form-control">

                                    <option value="-" selected>Selecionar</option>
                                    @foreach($grupos as $grupo)
                                    <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea name="descricao" id="" cols="30" rows="10" class="form-control"></textarea>
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