@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h5>Relatorio Matriculados</h3>
            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">

        </div>

        <div class="panel-body">
            <br>
            <table class="table table-bordered table-striped text-center">
                <tr >
                    <th colspan="5"></th>
                    <th colspan="11" ALIGN=CENTER>Estudantes com Propinas Pagas</th>
                    <th colspan="11" ALIGN=CENTER>Estudantes com Propinas em Dividas</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Matriculados</th>
                    <th>Desistidos</th>
                    <th>Activos</th>
                    <th>Mar</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Jan</th>
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Mai</th>
                    <th>Jun</th>
                    <th>Valor Arrecadado</th>
                    <th>Mar</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Jan</th>
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Mai</th>
                    <th>Jun</th>
                    <th>Valor por Arrecadar</th>

                </tr>


                @foreach($cursos as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$item->nome}}</td>
                    <td>{{\App\Curso::matriculados($item->id)}}</td>
                    <td>{{\App\Curso::desistidos($item->id)}}</td>
                    <td>{{\App\Curso::activos($item->id)}}</td>

                    <!--pagamentos-->
                    <td>{{\App\Curso::cantidadPagamentosMes(3,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(4,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(5,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(6,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(7,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(8,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(9,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(10,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(11,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadPagamentosMes(12,$item->id)}}</td>

                    <!--valor arecadado-->
                    <td>{{ number_format(\App\Curso::valorArecadado($item->id),2,',','.') }}</td>

                    <!--dividas-->
                    <td>{{\App\Curso::cantidadImpagosMes(3,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(4,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(5,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(6,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(7,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(8,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(9,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(10,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(11,$item->id)}}</td>
                    <td>{{\App\Curso::cantidadImpagosMes(12,$item->id)}}</td>

                    <!--valor por arecadar-->
                    <td>{{ number_format(\App\Curso::valorPorArecadar($item->id),2,',','.') }}</td>


                </tr>
                @endforeach
            </table>


        </div>
    </div>




    @stop