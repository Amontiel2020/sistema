@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        Filtros
    </div>
    <div class="panel-body">
        <form class="form-inline" action="{{route('procDiarioCaixaNovo')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="">Mes</label>
                <input type="month" name="data" id="data" class="form-control">

            </div>

            <input type="submit" class="btn-primary" value="Filtrar">
        </form>



    </div>

</div>
@if($collection!="[]")
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
            <a href="{{route('pdfEntradaSalida',[$mes,$ano])}}">Exportar PDF</a>

            <h3>Diario de Banco Referente à {{$stringMes}} de {{$ano}}</h3>
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
         
            <table class="table table-bordered table-striped">

                <tr>
                    <th>Nª /ord</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Recebimentos</th>
                    <th>Pagamentos</th>

                </tr>

                @foreach($collection as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td><?php echo date('d-m-Y', strtotime($item->created_at)) ?>
                       
                    </td>
                    <td>
                        {{$item->descricao}}
                    </td>
                    <td align="right">
                    @if($item->descricao=="Propinas e Emolumentos")
                    {{number_format($item->valor,2,',','.')}}
                    @endif
                    </td>
                    <td align="right">
                    @if($item->descricao!="Propinas e Emolumentos")
                    {{number_format($item->valor,2,',','.')}}
                    @endif
                    </td>

                </tr>
                @endforeach
                <tr>
                <td align="right" colspan="3"><b>Total:</b></td>
                <td align="right"> {{number_format($totalPagamentos,2,',','.')}}</td>
                <td align="right">{{number_format($totalDispesas,2,',','.')}}</td>

                
                </tr>

            </table>
          

        </div>
    </div>
@else
<h6>Selecione um mês</h6>
    @endif



    @stop