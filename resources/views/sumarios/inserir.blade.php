@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form role="form" action="{{route('save_sumario')}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="professor_id" value="{{ $prof_id }}">
<input type="hidden" name="disciplina_id" value="{{ $disc_id }}">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Registrar Sumário</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Titulo</label>
                <input class="form-control" type="text" name="titulo" required>

            </div>
            <div class="form-group">
                <label>Resumo</label>
                <textarea rows="15" class="form-control" name="resumo" require></textarea>

            </div>
            <div class="form-group">
               
              <button class="btn btn-primary btn-block">Registrar</button>

            </div>
        </div>
    </div>

</form>

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {

        $("#createEstudante_form").validate({


            rules: {
                nomeCompleto: {
                    required: true,
                    maxlength: 50,
                    //lettersonly: true 
                },

                telefone1: {
                    required: true,
                    minlength: 11,
                },
                telefone2: {
                    required: true,
                    minlength: 11,
                },
                telefoneEmergencia: {
                    required: true,
                    minlength: 11,
                },

                apelido: {
                    required: true,
                    maxlength: 500,
                },
                BI: {
                    required: true,
                    maxlength: 14,
                    minlength: 14,

                },


            },
            messages: {

                nomeCompleto: {
                    required: "É obrigatória a indicação de um valor para o campo nome.",
                },
                apelido: {
                    required: "É obrigatória a indicação de um valor para o campo apelido.",
                },
                telefone1: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                telefone2: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                telefoneEmergencia: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                BI: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 14 digitos",
                },

            },
        })

    });

    $(document).ready(function() {
        $("#telefone1, #telefone2").mask("Z00-000-000", {
            translation: {
                Z: {
                    pattern: /[9]/
                }
            }
        }).attr('minlength', 9);

        $("#BI").mask("000000000AA000", {
            translation: {
                A: {
                    pattern: /['BA']/
                }
            }
        }).attr('minlength', 14);
    });
</script>
@endSection


@stop