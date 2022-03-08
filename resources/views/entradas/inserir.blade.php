@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Inserir Entrada</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Entradas
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('storeEntrada')}}" id="createConsumivel_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            	<div class="form-group">
									<label>Data</label>
									<input class="form-control" type="date" name="data"  required>
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
                                <label>Preço Unitario</label>
                                <input class="form-control" type="text" name="precoUnitario">
                            </div>
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input class="form-control" type="text" name="qtd">
                            </div>
                            <div class="form-group">
                                <label>Valor</label>
                                <input class="form-control" type="text" name="valor">
                            </div>
                            <div class="form-group">
                                <label>Factura</label>
                                <input class="form-control" type="text" name="factura">
                            </div>
                            <div class="form-group">
                                <label>Fornecedor</label>
                                <input class="form-control" type="text" name="fornecedor">
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="col-lg-6">
                                                <button class="btn btn-primary btn-block" type="submit">Inserir</button>
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