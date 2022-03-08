@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Pagamento</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pagamento
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('updatePagamento',$pagamento->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label>Data</label>
                                <input class="form-control" type="date" name="data" value="<?php echo date('Y-m-d', strtotime($pagamento->created_at)) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Estudante</label>
                                <input class="form-control" type="text" name="estudante" value="{{$pagamento->estudante_id}}" required>
                            </div>
                            <div class="form-group">
                                <label>Valor</label>
                                <input class="form-control" type="text" name="valor" value="{{$pagamento->valor}}" required>
                            </div>
                            <div class="form-group">
                                <label>Mês</label>
                                <input class="form-control" type="text" name="mes" value="{{$pagamento->mes}}">
                            </div>
                            <div class="form-group">
                                <label>Ano</label>
                                <input class="form-control" type="text" name="ano" value="{{$pagamento->ano}}">
                            </div>
                            <div class="form-group">
                                <label>Meio de pagamento</label>
                                <select name="obs" class="form-control">
                                    <option value="TPA" @if($pagamento->obs=="TPA") selected @endif>TPA</option>
                                    <option value="Dinheiro" @if($pagamento->obs=="Dinheiro") selected @endif>Dinheiro</option>
                                    <option value="Transferência" @if($pagamento->obs=="Transferência") selected @endif>Transferência</option>
                                </select>
                               <!-- <input class="form-control" type="text" name="obs" value="{{$pagamento->obs}}">-->
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">




                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Observação</label>
                            <textarea class="form-control" name="descrip" rows="15">
                            {{$pagamento->descrip}}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-outline btn-success btn-block">Cancelar</button>
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