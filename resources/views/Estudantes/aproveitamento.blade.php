<table class="table table-bordered table-striped">

    <tr>
        <td>Nº</td>
        <th>Nome Completo</th>
        <th>Bilhete de Identidade</th>
        <th>Sexo</th>
        <th>Idade</th>
        <th>Data de Nascimento </th>
        <th>Província Residência</th>
        <th>Município de residência</th>
        <th>País de Origem</th>
        <th>Período de Estudo </th>
        <th>Unidad Organica</th>
        <th>Nome do Curso Inscrito no Ensino Superior </th>
        <th>Duração do Curso</th>


        <th>Ano de Frequência</th>

        <th>Situação Académica</th>

        <th>Aproveitamento Anual</th>


    </tr>


    @foreach($estudantes as $i=>$item)
    <tr>
        <td>{{$i+1}}</td>
        <td>{{$item->nome}} {{$item->apelido}}</td>
        <td>{{$item->BI}}</td>
        <td>{{$item->genero}}</td>
        <td>{{$item->idade}}</td>
        <td>{{$item->dataNac}}</td>
        <td>{{\App\Estudante::getProvincia($item->id)}}</td>
        <td>{{\App\Estudante::getMunicipio($item->id)}}</td>
        <td>Angola</td>
        <td>{{\App\Estudante::getPeriodo($item->id)}}</td>
        <td>ESPB</td>
        <td>{{\App\Curso::toString($item->curso_id)}}</td>
        <td>{{\App\Curso::duracao($item->curso_id)}}</td>
        <td>2</td>
        <td>
            @if($item->estado=="Activo")
            Em Continuação dos Estudos
            @else
            {{$item->estado}}
            @endif
        </td>
        <td>
        {{\App\Estudante::getAproveitamento($item->id)}} 
        </td>
    </tr>
    @endforeach

</table>