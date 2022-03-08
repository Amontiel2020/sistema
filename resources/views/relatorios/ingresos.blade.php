@extends('relatorios.cabecalho')

@section('content')
<br>

<h3>Relatório dos ingresos</h3>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Conceito</th>
                <th>Valor</th>
 
            </tr>                            
        </thead>
        <tbody>
    
            <tr>
                <td>Inscrição</td>
                
                <td>{{ number_format($valorInscricao,2,',','.') }}</td>

            </tr>
            <tr>
                <td>Matricula</td>
                <td>{{ number_format($valorMatricula,2,',','.') }}</td>

            </tr>
            <tr>
                <td>Propinas</td>
                <td>{{ number_format($valorPropina,2,',','.') }}</td>

            </tr>
            <tr>
                <td><b>Total</b></td>
                <td>{{ number_format($total,2,',','.') }}</td>

            </tr>
           
        </tbody>
    </table>
@endsection