@extends('layouts.Main')

@section('content')

@section('estilos')

@endSection

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">


    <form role="form" action="{{route('store_funcionario')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Actualizar Candidato</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- formtarget="_blank" target="_blank"  -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Painel Identifiação do colaborador -->
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h5 align="center"><b>Identificação do Candidato</b></h5>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label>Nome Completo</label>
                                        <input class="form-control" type="text" name="nome_completo" value="{{$candidato->nome_completo}}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select name="sexo" class="form-control">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Feminino">Feminino</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Estado Civil</label>
                                                <select name="estado_civil" class="form-control">
                                                    <option value="Solteiro">Solteiro</option>
                                                    <option value="Casado">Casado</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Data Nascimento</label>
                                                <input min="1970-01-01" max="2006-12-31" class="form-control" type="date" name="data_nac" value="{{$candidato->data_nac}}">
                                                <span class="text-danger">{{ $errors->first('dataNac') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Número de Filhos</label>
                                                <input name="numero_filhos" type="text" class="form-control" value="{{$candidato->numero_filhos}}">
                                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5 align="center"><b>Documentação Individual</b></h5>
                                            <div class="form-group">
                                                <label>Nº do Bilhete de Identidade</label>
                                                <input class="form-control" type="text" id="BI" name="numero_bi" value="{{$candidato->numero_bi}}" required>
                                                <span class="text-danger">{{ $errors->first('BI') }}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Data Emissão do BI </label>
                                                        <input min="2010-08-14" max="{{$date}}" class="form-control" type="date" name="data_emissao_bi" value="{{$candidato->data_emissao_bi}}" required>
                                                        <span class="text-danger">{{ $errors->first('BI') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Data de Validade do BI </label>
                                                        <input min="{{$date}}" class="form-control" type="date" name="data_validade_bi" value="{{$candidato->data_validade_bi}}" required>
                                                        <span class="text-danger">{{ $errors->first('BI') }}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Nº Contribuinte </label>
                                                        <input class="form-control" type="text" name="num_contribuinte" value="{{$candidato->num_contribuinte}}" required>
                                                        <span class="text-danger">{{ $errors->first('BI') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Nº Segurança Social </label>
                                                        <input class="form-control" type="text" name="num_seguranca_social" value="{{$candidato->num_seguranca_social}}" required>
                                                        <span class="text-danger">{{ $errors->first('BI') }}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Nome do pai</label>
                                                        <input class="form-control" type="text" name="nome_pai" value="{{$candidato->nome_pai}}" required>
                                                        <span class="text-danger">{{ $errors->first('nomePai') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Nome da Mae</label>
                                                        <input class="form-control" type="text" name="nome_mae" value="{{$candidato->nome_mae}}" required>
                                                        <span class="text-danger">{{ $errors->first('nomeMai') }}</span>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>


                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5 align="center"><b>Naturalidade</b></h5>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Provincia</label>
                                                        <select id="provNaturaliade" name="provincia" class="form-control">
                                                            @foreach($provincias as $provincia)
                                                            <option value="{{$provincia->id}}">{{$provincia->nome}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Municipio</label>
                                                        <select id="munNaturalidade" name="municipio" class="form-control">
                                                            <option value="-">-</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="form-group">
                                                <label>Nacionalidade</label>
                                                <input class="form-control" type="text" name="nacionalidade" value="{{$candidato->nacionalidade}}" required>
                                                <span class="text-danger">{{ $errors->first('nacionalidade') }}</span>
                                            </div>

                                            <div id="ProvMunicipio">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- fim Painel  Identifiação do colaborador -->
                            <!--
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 align="center"><b> Condições Salariais</b></h5>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Salario Base</label>
                                                <input class="form-control" type="text" name="salarioBase" >
                                                <span class="text-danger">{{ $errors->first('salarioBase') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Outras Remunerações</label>
                                                <input class="form-control" type="text" name="ourasRemuneracoes" >
                                                <span class="text-danger">{{ $errors->first('salarioBase') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Categoria Profissional</label>
                                                <select name="categoria" class="form-control">
                                                    <option value="categoria1">Categoria 1</option>
                                                    <option value="categoria2">Categoria 2</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Data Admissão </label>
                                                <input min="2010-08-14" max="{{$date}}" class="form-control" type="date" name="dataAdmissao" >
                                                <span class="text-danger">{{ $errors->first('BI') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de Contrato</label>
                                        <select name="tipoContrato" class="form-control">
                                            <option value="tipo1">Tipo 1</option>
                                            <option value="tipo2">Tipo 2</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('genero') }}</span>
                                    </div>
                                </div>

                            </div>  -->
                        </div>


                        <div class="col-md-6">
                            <!--

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 align="center"><b> Outras condições acordadas</b></h5>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Alojamento nas Instalações da Instituição</label>
                                        </div>
                                        <div class="col-xs-6"></div>
                                        <div class="form-group">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary ">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" > Sim
                                                </label>
                                                <label class="btn btn-secondary active">
                                                    <input type="radio" name="options" id="option2" autocomplete="off" checked> Não
                                                </label>

                                            </div>
                                            <span class="text-danger">{{ $errors->first('salarioBase') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Alimentação</label>
                                        </div>
                                        <div class="col-xs-6"></div>
                                        <div class="form-group">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary ">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" > Sim
                                                </label>
                                                <label class="btn btn-secondary active">
                                                    <input type="radio" name="options" id="option2" autocomplete="off" checked> Não
                                                </label>

                                            </div>
                                            <span class="text-danger">{{ $errors->first('salarioBase') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Transporte da Instituição</label>
                                        </div>
                                        <div class="col-xs-6"></div>
                                        <div class="form-group">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary ">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" > Sim
                                                </label>
                                                <label class="btn btn-secondary active">
                                                    <input type="radio" name="options" id="option2" autocomplete="off" checked> Não
                                                </label>

                                            </div>
                                            <span class="text-danger">{{ $errors->first('salarioBase') }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Habilitações Literarias</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Mestrado em:</label>
                                                <input type="text" class="form-control" name="mestrado_em">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Área Cientifica:</label>
                                                <input type="text" class="form-control" name="mestrado_area_cientifica">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Universidade:</label>
                                                <input type="text" class="form-control" name="mestrado_universidade">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">PhD em:</label>
                                                <input type="text" class="form-control" name="phd_em">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Área Cientifica:</label>
                                                <input type="text" class="form-control" name="phd_area_cientifica">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Universidade:</label>
                                                <input type="text" class="form-control" name="phd_universidade">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-panel-heading">
                                    <h4>Línguas Estrangeiras</h4>

                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Documentos </label>
                                            </div>

                                        </div>


                                        <div class="checkbox">
                                            <label>
                                                <input id="ingles" name="ingles" type="checkbox" value="ingles">Inlges
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input id="frances" name="frances" type="checkbox" value="frances">Frances
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input id="outro" name="outro" type="checkbox" value="outro">Outro
                                            </label>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label for="">Qual:</label>
                                        <input type="text" name="qual" id="" class="form-control">
                                        </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Telefones</h4>
                                </div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input class="form-control" type="text" id="telefone1" name="telefone1" placeholder="Telef. 1" value="{{$candidato->telefone1}}" required>

                                            </div>
                                            <span class="text-danger">{{ $errors->first('telefone1') }}</span>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input class="form-control" type="tel" id="telefone2" name="telefone2" placeholder="Telef. 2" value="{{$candidato->telefone2}}" required>
                                                <span class="text-danger">{{ $errors->first('telefone2') }}</span>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="text-danger text-muted">ex. 999-999-999</small>
                                                    <small class="text-danger text-muted"> * Obrigatorio iniciar com 9</small>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="panel panel-default">
                                <h3 align="center">Morada</h3>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Rua-Bairro-Zona</label>
                                        <input class="form-control" type="text" name="zona_morada" value="{{$candidato->zona_morada}}" required>
                                        <span class="text-danger">{{ $errors->first('endereco') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <h3 align="center">Documentos</h3>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Documentos </label>
                                            </div>

                                        </div>

                                        @foreach($documentos as $documento)
                                        <div class="checkbox">
                                            <label>
                                                <input required id="documentos[]" name="documentos[]" type="checkbox" value="{{$documento->id}}" data-msg-required="É Obrigatorio.">{{$documento->nome}} <span style="color: red;">*</span>
                                            </label>
                                        </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>


                            <!--		<div class="form-group ">

							<label for="">Image</label>
							<input id="file-input" name="imagenperfil" type="file" />

						</div>  -->



                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="col-lg-6">
                                <button id="botonConfirmar" class="btn btn-primary btn-block" type="submit">Actualizar</button>
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

    $("#provNaturaliade").change(function(event) {
        var id_prov = $(this).val();

        url = "/municipios/" + id_prov + "";

        $.getJSON(url, function(response, state) {
            $('#munNaturalidade').empty();

            $.each(response, function(k, v) {
                $('#munNaturalidade').append('<option value=' + v.id + '>' + v.nome + '</option>');

            });



        });

    });

    $("#provEndereco").change(function(event) {
        var id_prov = $(this).val();

        url = "/municipios/" + id_prov + "";

        $.getJSON(url, function(response, state) {
            $('#munEndereco').empty();

            $.each(response, function(k, v) {
                $('#munEndereco').append('<option value=' + v.id + '>' + v.nome + '</option>');

            });



        });

    });



    $("#telefone1, #telefone2, #telefoneEmergencia").mask("Z00-000-000", {
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

    $(document).ready(function() {
        $('#open').on('click', function() {
            $('#popup').fadeIn('slow');
            $('.popup-overlay').fadeIn('slow');
            $('.popup-overlay').height($(window).height());
            return false;
        });

        $('#close').on('click', function() {
            $('#popup').fadeOut('slow');
            $('.popup-overlay').fadeOut('slow');
            return false;
        });
    });

    /*	$(function() {
    		$("#telefone1").mask('ZA', {
    			translation: {
    				Z: {
    					pattern: /[9]/
    				},
    				A: {
    					pattern: /[0-9]/,
    					recursive: true
    				}
    			}
    		});
    	});*/

    /*		function ValidaTel(val) {
    			if (val.length < 11)
    				alert("O telefone não pode ter menos de 9 digitos");
    		}*/
    //onBlur="javascript: ValidaTel(this.value);"




    $(function() {
        $("input[type='checkbox']").change(function(event) {
            cantidadCheckbox = $("input[type='checkbox']").length;
            cantidadCheckboxSelec = $("input[type='checkbox']:checked").length;
            //	alert("Cantidad total" + cantidadCheckbox);
            //	alert("Cantidad selec" + cantidadCheckboxSelec);

            if (cantidadCheckboxSelec < cantidadCheckbox) {

                $('#botonConfirmar').prop('disabled', true);
            }

            if (cantidadCheckboxSelec == cantidadCheckbox) {
                $('#botonConfirmar').prop('disabled', false);
            }
        });




    });

    function contar() {
        var checkboxes = document.getElementById("form1").checkbox; //Array que contiene los checkbox

        var cont = 0; //Variable que lleva la cuenta de los checkbox pulsados

        for (var x = 0; x < checkboxes.length; x++) {
            if (checkboxes[x].checked) {
                cont = cont + 1;
            }
        }

        alert("El número de checkbox pulsados es " + cont);
    }
</script>
@endSection


@stop