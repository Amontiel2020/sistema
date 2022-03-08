@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Saida</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Saidas
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('updateSaida',$saida->id)}}" id="createSaida_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            	<div class="form-group">
									<label>Data</label>
									<input class="form-control" type="date" name="data"  value="<?php echo date('Y-m-d', strtotime($saida->created_at)) ?>" required>
									<span class="text-danger">{{ $errors->first('data') }}</span>
								</div>
                            <div class="form-group">
                                <label>Consumivel</label>
                                <select name="consumivel" class="form-control">
                                    @foreach($consumiveis as $consumivel)
                                    <option value="{{$consumivel->id}}">{{$consumivel->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input class="form-control" type="text" name="qtd" value="{{ $saida->qtd}}">
                            </div>
                            <div class="form-group">
                                <label>Destinatario</label>
                                <input class="form-control" type="text" name="destinatario" value="{{ $saida->destinatario}}">
                            </div>
                            <div class="form-group">
                                <label>Responsavel</label>
                                <input class="form-control" type="text" name="responsavel" value="{{ $saida->responsavel}}">
                            </div>
                            <div class="form-group">
                                <label>Observações</label>
                                <input class="form-control" type="text" name="obs" value="{{ $saida->obs}}">
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