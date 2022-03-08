@extends('layouts.Main')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{ route('inserirEstudantes') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Selecione o estudante para ver sua conta</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('mostrarConta') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                {!! Form::select('estudanteConta', $listaEstudantes, null, ['id' => 'estudanteConta', 'style' => 'width: 50%']) !!}
                <select name="ano" id="ano">
                    <option @if($ano==2020) selected @endif value="2020">2020</option>
                    <option @if($ano==2021) selected @endif value="2021" selected>2021</option>

                </select>
                <button type="submit" class="btn btn-primary">Enviar</button>

            </form>
        </div>
    </div>
    @if (isset($conta))

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h3>Conta do estudante {{ \App\Estudante::toString($conta->estudante_id) }}</h3>
                </div>
                <div class="col-xs-6">
                    <h3>Ano Académico: {{$ano}}/{{$ano+1}}</h3>
                </div>
            </div>
            <h3>Nº: {{ $conta->numero }}</h3>

            <h3> <label class="label label-info"> Total a
                    pagar: {{number_format($conta->totalPagar,2,',','.') }} </label></h3>

            @if($conta->totalTaxas>0) <h3> <label class="label label-danger"> Total de dividas em Taxas: {{number_format($conta->totalTaxas,2,',','.') }} </label></h3>@endif
            <p>Contencioso:
                @if($conta->is_contencioso==1)
                <img src="{{url('/storage/boton_activo.jpg') }}" alt="">
                @endif
                @if($conta->is_contencioso==0)
                <img src="{{url('/storage/boton_inactivo.jpg') }}" alt="">
                @endif
            </p>

            <p class="text-right"> <label class="label label-success"><a href="{{ route('estado_conta', [$conta->estudante_id, 2020]) }}">Estado de
                        Conta</a></label>

            </p>


        </div>
        <div class="panel-body">


            <h3>Propinas ano academico {{$ano}}/{{$ano+1}}</h3>

            <div id="conta" data-conta-id="{{ $conta->id }}"></div>

            <div class="row">
                <div class="col-xs-6">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Mês</th>
                            <th>Pagamento</th>
                            <th>Taxa</th>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="1" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">
                                <!--  <input type="hidden" name="taxa" value="{{ \App\Http\Controllers\Caixa::calcularTaxa(3, 2020) }}">-->
                                <input type="hidden" name="mes" value="1">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Setembro
                                    @else
                                    Outubro
                                    @endif

                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 1, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="1">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 1, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(3, 2020) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select class="taxa" name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>



                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="2" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">
                                <input type="hidden" name="mes" value="2">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Outubro
                                    @else
                                    Novembro
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 2, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="2">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 2, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(4, 2020) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="3" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="3">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Novembro
                                    @else
                                    Dezembro
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 3, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="3">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 3, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(5, 2020) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar">

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="4" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="4">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Dezembro
                                    @else
                                    Janeiro
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 4, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="4">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 4, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(6, 2020) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="5" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="5">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Janeiro
                                    @else
                                    Fevereiro
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 5, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="5">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 5, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(7, 2020) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="6" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="6">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Fevereiro
                                    @else
                                    Março
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 6, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="6">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 6, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(2, 2021) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="7" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="7">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Março
                                    @else
                                    Abril
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 7, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="7">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 7, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(3, 2021) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="8" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="8">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Abril
                                    @else
                                    Maio
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 8, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="8">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 8, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(4, 2021) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="9" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="9">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Maio
                                    @else
                                    Junho
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 9, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="9">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 9, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(5, 2021) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input type="checkbox" name="naoPagar" class="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else



                                    @endif
                                </td>

                            </form>

                        </tr>
                        <tr>
                            <form action="{{ route('registrarPagamentoTemp') }}" id="10" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <input type="hidden" name="emolumento_id" value="1">

                                <input type="hidden" name="mes" value="10">
                                <input type="hidden" name="ano" value="{{$ano}}">
                                <input type="hidden" name="valor" value="25000">

                                <td>
                                    @if($ano==="2020")
                                    Junho
                                    @else
                                    Julho
                                    @endif
                                </td>
                                <td>
                                    @if (\App\Conta::mesPago($conta->id, 10, $ano))
                                    <label class="label label-success">Liquidada 25000</label>
                                    @else


                                    <div class="form-group">
                                        <label>Forma Pagamento </label>

                                        <select multiple="multiple" name="formas_pagamento" class="form-control">
                                            <option>TPA</option>
                                            <option>Transf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Observação </label>

                                        <textarea name="obs" class="form-control">

                                               </textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block pagamento" value="10">Pagar</a>

                                    </div>


                                    @endif
                                </td>
                                <td>
                                    @if (!\App\Conta::mesPago($conta->id, 10, $ano))
                                    <!--   <label> Valor:</label>
                                            <label class="label label-danger"> {{ \App\Http\Controllers\Caixa::calcularTaxa(6, 2021) }}</label> -->
                                    <div class="form-group">
                                        <label for="">Valor:</label>
                                        <select name="taxa" class="form-control taxa">
                                            <option value="0" selected>0</option>
                                            <option value="1250">1250</option>
                                            <option value="2500">2500</option>
                                            <option value="3750">3750</option>
                                            <option value="5000">5000</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pagar sem multa</label>
                                        <input class="naoPagar" type="checkbox" name="naoPagar" disabled>

                                    </div>
                                    <div class="form-group">
                                        <label>Pagar prestação de</label>
                                        <input type="number" name="somente" class="form-control somente" disabled>

                                    </div>
                                    <label>Desconto</label>
                                    <select name="desconto" class="form-control taxa">
                                        <option value="0" selected>0</option>
                                        <option value="1250">1250</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    @else


                                    @endif
                                </td>

                            </form>

                        </tr>


                    </table>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Selecione um emolumento para pagar</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('registrarEmolumentoPagamentoTemp') }}" method="post" id="formPagamentoEmolumento">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="conta_id" value="{{ $conta->id }}">
                                <div class="form-group">
                                    <label>Emolumento</label>
                                    {!! Form::select('emolumento_id', $listaEmolumentos, null, ['class' => 'form-control', 'id' => 'emolumentosPagamentos', 'style' => 'width: 100%']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Meio Pagamento</label>
                                    <select multiple="multiple" name="formas_pagamento" class="form-control">
                                        <option>TPA</option>
                                        <option>Transf</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea name="obs" class="form-control">

                                        </textarea>
                                </div>
                                <div class="form-group">

                                    <a href="#" id="pagamentoEmolumento" class="btn btn-primary btn-block">Enviar</a>
                                </div>


                            </form>
                        </div>
                    </div>




                </div>

                <div class="col-xs-6">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="container-fluid">
                                <!-- primera parte -->
                                <div class="row">
                                    <div class="col-xs-12" align="center">

                                        <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">

                                        <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->

                                        <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                                        <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                                        <p>Recibo de pagamentos</p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-9">
                                        <p><b>Nome do Estudante:</b>&nbsp;{{ $estudante->nome }}
                                            &nbsp;{{ $estudante->apelido }} &nbsp;&nbsp;&nbsp; <b>Nº:</b>
                                            &nbsp;{{ $estudante->id }} </p>
                                        <p><b>Nº do BI:</b> &nbsp;{{ $estudante->BI }} &nbsp;&nbsp;&nbsp; <b>
                                                Curso:</b> &nbsp;{{ $estudante->curso }} <b> Turma:</b>
                                            &nbsp;{{ \App\Turma::toString($estudante->turma_id) }} </p>
                                        <p align="right"><b>Ano Acadêmico:</b>&nbsp;</p>
                                        <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <form action="{{ route('confirmar_pagamentos_tmp', $conta->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <table id="idTable" class="table table-bordered table-striped">
                                                <tr>
                                                    <th>Designação</th>
                                                    <th>Emolumento</th>
                                                    <th>Mês</th>
                                                    <th>Valor</th>
                                                    <th>Taxa</th>
                                                    <th>Formas de Pago</th>
                                                    <th>Obs</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="tbodyPagamentos">
                                                    <!--  <tr>
                             <td id="designacao_table"></td>
                             <td id="emolumento_table"></td>
                             <td id="mes_table"></td>
                             <td id="valor_table"></td>
                             <td id="taxa_table"></td>
                             <td id="formas_table"></td>
                             <td id="obs_table"></td>
                             <td id=""></td>
                             </tr>-->

                                                </tbody>



                                            </table>
                                            <button type="submit" class="btn btn-primary btn-block">Confirmar
                                                Pagamentos</button>


                                    </div>
                                </div>






                            </div>
                        </div>

                    </div>



                </div>




            </div>





            @endif

            @section('scripts')

            <script>
                var id = "";
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });


                    $('#comments').click(function() {
                        // alert('OK');

                    });

                    cargarDatos();


                    $('#estudanteConta').select2({

                    });
                    $('#emolumentosPagamentos').select2({

                    });


                    $('.pagamento').click(function() {
                        id = $(this).attr('value');



                        $.ajax({
                            url: 'registrarPagamentoTemp',
                            type: 'post',
                            dataType: 'json',
                            data: $('#' + id).serialize(),
                            success: function(data) {

                            }
                        });
                        cargarDatos();

                    });

                    $('#pagamentoEmolumento').click(function() {
                        alert('OK');



                        $.ajax({
                            url: 'registrarEmolumentoTemp',
                            type: 'post',
                            dataType: 'json',
                            data: $('#formPagamentoEmolumento').serialize(),
                            success: function(data) {

                            }
                        });
                        cargarDatos();


                    });

                    /* $('#pagamento_taxa').click(function() {
                          // alert('OK');



                          $.ajax({
                              url: 'registrar_pagamento_taxa',
                              type: 'post',
                              dataType: 'json',
                              data: $('#pagamento_taxa').serialize(),
                              success: function(data) {

                              }
                          });
                          cargarDatos();


                      });*/

                    $(".taxa").change(function(event) {
                        valor = $(this).val();
                        if (valor != 0) {
                            $(".naoPagar").attr('disabled', false);
                            $(".somente").attr('disabled', false);

                        }
                        if (valor == 0) {
                            $(".naoPagar").attr('disabled', true);
                            $(".somente").attr('disabled', true);

                        }

                    });



                });

                function cargarDatos() {




                    var conta_id = $("#conta").data("conta-id");
                    url = "getJsonPagamentosTemp/" + conta_id + "";

                    $.getJSON(url, function(response, state) {
                        $("#tbodyPagamentos").empty();

                        $.each(response, function(k, v) {

                            nameFormPago = "name=" + '"' + "formasDePago" + v.id + "[]" + '"';
                            multiple = '"' + "multiple" + '"';
                            botonFormasPago = "<select " + "multiple=" + multiple + nameFormPago + "class=" +
                                ">" +
                                "<option>TPA</option>" +
                                "<option>Dinheiro</option>" +
                                "<option>Transferência</option>" +
                                "</select>";
                            nameBotonObsGeral = "name=" + '"' + "obsGeral" + '"';
                            botonObsGeral = "<textarea " + nameBotonObsGeral + ">" + "</textarea>";


                            enlace =
                                '<a href="#" id="comments" data-type="textarea" data-pk="1">awesome comment!</a>';

                            $("#tbodyPagamentos").append(
                                "<tr><td>" +
                                v.designacao +
                                "</td><td>" +
                                v.emolumento_id +
                                "</td><td>" +
                                v.mes +
                                "</td><td>" +
                                v.valor +
                                "</td><td>" +
                                v.taxa +
                                "</td><td>" +
                                v.obs +
                                "</td><td>" +
                                v.descrip +
                                "</td></tr>");

                            /*  $("#designacao_table").append(v.designacao);
                              $("#emolumento_table").append(v.emolumento_id);
                              $("#mes_table").append(v.mes);
                              $("#valor_table").append(v.designacao);
                              $("#designacao_table").append(v.designacao);
                              $("#designacao_table").append(v.designacao);
                              $("#designacao_table").append(v.designacao);*/


                        });
                    });





                }
            </script>

            @endsection

            @stop