<table class="table table-bordered table-striped">

    <tr>
        <td>Nº Ordem</td>
        <th>Nome Completo</th>
        <th>Numero de Estudante</th>
        <th>Curso</th>
        <th>Periodo</th>
     </tr>
    @foreach($estudantes as $i=>$item)
    <tr>
        <td>{{$i+1}}</td>
        <td>{{$item->nome}}</td>
        <td>{{$item->codigo}}</td>
        <td>{{\App\Curso::toString($item->curso_id)}}</td>
        <td>
                @if($turma->periodo=="M")
                Manhã
                @endif
                @if($turma->periodo=="T")
                Tarde
                @endif
                @if($turma->periodo=="N")
                Noite
                @endif

        </td>
  
    </tr>
    @endforeach

</table>