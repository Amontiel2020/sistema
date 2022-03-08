<table class="table table-bordered table-striped">
    <tr>
        <th colspan="2"></th>
        <th colspan="3">Frequências</th>
        <th></th>
        <th colspan="3">EXAMES</th>
        <th colspan="2">Resultado da média final</th>
    </tr>
    <tr>
        <td>#</td>
        <th>Nome do Aluno</th>
        <th>F1</th>
        <th>F2</th>
        <th>MAC</th>
        <th>M</th>
        <th>EX1</th>
        <th>EX2</th>
        <th>EX3</th>
        <th>MF</th>
        <th>Resultado</th>
    </tr>


    @foreach($estudantes as $i=>$item)
    <tr>
        <td>{{$i+1}}</td>
        <td>{{$item->nome}} {{$item->apelido}}</td>
        <td>
           
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad)}}
            
        </td>
        <td>
           
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad)}}
            
        </td>
        <td>
          
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",$anoAcad)}}
            
        </td>
        <td>{{\App\Pauta::obterMedia($item->id,$idDisc,$anoAcad)}}</td>
        <td>
          
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)}}
          
        </td>
        <td>
          
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)}}

        </td>
        <td>
    
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad)}}
   
        </td>
        <td>
         
            {{\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)}}
            

        </td>
        <td>

        </td>
    </tr>
    @endforeach

</table>