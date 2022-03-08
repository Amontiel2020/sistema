@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Livro</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Livro
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form role="form" action="{{route('updateLivro')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $livro->id }}">

                            <div class="form-group">
                                <label>Titulo</label>
                                <input class="form-control" type="text" name="titulo" value="{{$livro->titulo}}" required>

                            </div>
                            <div class="form-group">
                                <label>Autor</label>
                                <input class="form-control" type="text" name="autor" value="{{$livro->autor}}" required>

                            </div>
                            <div class="form-group">
                                <label>Edição</label>
                                <input class="form-control" type="text" name="edicao" value="{{$livro->edicao}}">

                            </div>
                            <div class="form-group">
                                <label>Editora</label>
                                <input class="form-control" type="text" name="editora" value="{{$livro->editora}}">

                            </div>
                            <div class="form-group">
                                <label>ano</label>
                                <input class="form-control" type="number" name="ano" value="{{$livro->ano}}">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pais</label>
                                        <br>
                                        {!! Form::select('pais',$pais,null,['class'=>'form-control','id'=>'paisOrigem','style'=>'width: 50%']) !!}


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <input class="form-control" type="number" name="qtd" value="{{$livro->qtd}}">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Código Barra</label>
                                <input class="form-control" type="text" name="codBarra" value="{{$livro->codBarra }}">
                            </div>
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="categoria" class="form-control">
                                <option value="-">-</option>
                                @foreach($categorias as $categoria)
                                    <option @if($livro->cat_livro_id==$categoria->id) selected @endif value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                              
                                <select name="curso" class="form-control">
                                <option value="-">-</option>
                                    @foreach($cursos as $curso)
                                    <option @if($livro->curso_id==$curso->id) selected @endif value="{{$curso->id}}">{{$curso->nome}}</option>
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
    if ($("#createEstudante_form").length > 0) {
        $('#createEstudante_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");

        $("#createEstudante_form").validate({

            rules: {
                nome: {
                    required: true,
                    maxlength: 50,
                    //lettersonly: true 
                },

                /*     email: {
                    required: true,
                    maxlength: 50,
                    email: true,
				
                },*/

                apelido: {
                    required: true,
                    maxlength: 500,
                },
            },
            messages: {

                nome: {
                    required: "É obrigatória a indicação de um valor para o campo nome.",
                },
                apelido: {
                    required: "É obrigatória a indicação de um valor para o campo apelido.",
                },
                email: {
                    required: "É obrigatória a indicação de um valor para o campo email.",
                    email: "Email não valido",
                    maxlength: "The email name should less than or equal to 50 characters",
                },

            },
        })
    }

    $('#paisOrigem').change(function() {

        var pais = $(this).val()
        if (pais == 8) {
            $('#ProvMunicipio').show();
        }
        if (pais != 8) {
            $('#ProvMunicipio').hide();
        }

        //	alert('Has seleccionado ' + pais);

    });

    $("#telefone1, #telefone2, #telefone3").mask("000-000-000");
</script>
@endSection


@stop