@extends('layouts.Main')

@section('estilos')
<style>

</style>
@endSection



@section('content')
<br>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 align="center">Contas Correntes</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <label for="">Nome do estudante</label>
                {!! Form::select('estudante',$estudante,null,['id'=>'estudante','style'=>'width: 50%']) !!}
            </div>

            <div class="col-md-6">
                <label for="">Ano Academico</label>
                <select name="anoPagamento" id="anoPagamento">
                    <option value="2020" selected>2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
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




<!--   <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h4>Inserir Pagamento</h4>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label for="">Ano Academico</label>
                    <select name="anoPagamento" id="anoPagamento" class="form-control">
                        <option value="2020" selected>2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>


                    </select>
                </div>

                <div class="form-group">
                    <label for="">Turma</label>
                    <select name="turma" id="turma" class="form-control">
                        @foreach($turmas as $item)
                        <option value="{{$item->id}}">{{$item->identificador}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nome do estudante</label>
                    <select name="estudante" id="selectEstudantes" class="form-control"></select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="propinas" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Propina
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="emolumentos" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Emolumento
                    </label>
                </div>
                <div class="form-group">
                    {!! Form::select('estudante',$estudante,null,['id'=>'estudante','style'=>'width: 50%']) !!}

                </div>


            </div>
        </div>
    </div>
-->
<div id=divMainPagamentos class="ocultar">
    <div class="col-md-12">
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div id="foto" class="panel-body">

                            </div>
                        </div>
                        <div id="estadoConta"></div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                                <b>Nome:&nbsp;</b><span id="nomeEstudante"></span>&nbsp;<b>Nº:&nbsp;</b><span id="nomeEstPagamento"></span><br>
                                &nbsp;<b>BI:&nbsp;</b><span id="bi"></span>
                                &nbsp;<b>Curso:&nbsp;</b><span id="cursoEst"></span><br>
                                <span id="turmaEst"></span>
                            </div>
                            <div class="col-md-3">
                                Ano academico: <span id="anoEstPagamento"><b></b></span>
                            </div>

                        </div>
                        <br>
                        <br>
                        <h5>Pagamentos Realizados</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Designação</th>
                                    <th>Mes</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Obs</th>

                                </tr>

                            </thead>
                            <tbody id="pagamentosFeitos">

                            </tbody>

                        </table>



                    </div>
                </div>

            </div>
        </div>

        <!-------formulario ------------------------------------------------>
        <div id="panelPagamentos" class="panel panel-info">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">



                        <div class="col-md-1">
                            <button id="1" class="btn btn-xs btn-default btn-pagamento">Inscrição</button>


                        </div>



                        <div class="col-md-1">
                            <a id="2" class="btn btn-xs btn-default btn-pagamento">Matricula</a>

                        </div>



                        <div class="col-md-1">
                            <button id="3" class="btn btn-xs btn-default btn-pagamento">p.Março</button>
                        </div>



                        <div class="col-md-1">
                            <button id="4" class="btn btn-xs btn-default btn-pagamento">p.Outubro</button>
                        </div>



                        <div class="col-md-1">
                            <button id="5" class="btn btn-xs btn-default btn-pagamento">p.Novembro</button>
                        </div>



                        <div class="col-md-1">
                            <button id="6" class="btn btn-xs btn-default btn-pagamento">p.Dezembro</button>
                        </div>



                        <div class="col-md-1">
                            <button id="7" class="btn btn-xs btn-default btn-pagamento">p.Janeiro</button>
                        </div>



                        <div class="col-md-1">
                            <button id="8" class="btn btn-xs btn-default btn-pagamento">p.Fevereiro</button>
                        </div>



                        <div class="col-md-1">
                            <button id="9" class="btn btn-xs btn-default btn-pagamento">p.Março</button>
                        </div>



                        <div class="col-md-1">
                            <button id="10" class="btn btn-xs btn-default btn-pagamento">p.Abril</button>
                        </div>



                        <div class="col-md-1">
                            <button id="11" class="btn btn-xs btn-default btn-pagamento">p.Maio</button>
                        </div>



                        <div class="col-md-1">
                            <button id="12" class="btn btn-xs btn-default btn-pagamento">p.Junho</button>
                        </div>




                    </div>
                </div>
            </div>
        </div>





        <div id="MisEmolumentos">
            {!! Form::select('emolumento[]',$emolumentos,null,['id'=>'emolumento','style'=>'width: 50%']) !!}


        </div>




        <!-- fin formulario --------------------->
        <br>

        <div id="tabelaPagamentos" class="ocultar">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 align="center">Pagamentos a realizar</h3>

                    <div class="panel panel-default">
                        <form role="form" action="{{route('storePagamentos')}}" id="formularioPagosRealizados" method="POST">
                            <input type="hidden" name="valores" id="nameHiddenJsonData" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <table id="table-pagamentos" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Designação</th>
                                        <th>Mes</th>
                                        <th>Valor</th>
                                        <th>Taxa</th>
                                        <th>Meio Pagamento</th>
                                        <th>Quantias(para varios meios)</th>
                                        <th>Obs</th>
                                    </tr>
                                </thead>
                                <tbody id="pagamentosRealizar">

                                </tbody>



                            </table>
                            <button type="submit" id="registrarPagamentos" class="btn btn-success btn-lg btn-block">Registrar Pagamentos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>



@stop