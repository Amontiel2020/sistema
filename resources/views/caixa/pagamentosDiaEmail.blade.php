<table class="table table-hover table-bordered">
    <thead>
        <tr>

            <th>Designação</th>
            <th>Estudante</th>
            <th>Mes</th>
            <th>Valor</th>
            <th>Obs</th>

        </tr>
    </thead>
    <tbody>
        @foreach($pagamentos as $pagamento)
        <tr>
            <td>
                @if($pagamento->mes==1)
                <span>Inscrição</span>
                @elseif($pagamento->mes==2)
                <span>Matricula</span>
                @else
                {{\App\Emolumento::toString($pagamento->emolumento_id)}}
                @endif

            </td>
            <td>{{\App\Pagamento::toStringEstudante($pagamento->estudante_id)}}</td>
            <td>
                @switch($pagamento->mes)
                @case(1)
                <span> Janeiro</span>
                @break

                @case(2)
                <span>Fevereiro</span>
                @break
                @case(3)
                <span>Março</span>
                @break
                @case(4)
                <span>Outubro</span>
                @break
                @case(5)
                <span>Novembro</span>
                @break
                @case(6)
                <span>Dezembro</span>
                @break
                @case(7)
                <span>Janeiro</span>
                @break
                @case(8)
                <span>Fevereiro</span>
                @break
                @case(9)
                <span>Março</span>
                @break
                @case(10)
                <span>Abril</span>
                @break
                @case(11)
                <span>Maio</span>
                @break
                @case(12)
                <span>Junho</span>
                @break


                @endswitch
            </td>
            <td>{{number_format($pagamento->valor,2,',','.') }}</td>
            <td>{{$pagamento->obs}}</td>



        </tr>
        @endforeach
 

    </tbody>
</table>