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
        <th>Nota do Exame de Acesso</th>
        
        
        <th>Admissão</th>

        <th>Matriculados pela 1º vez</th>

        <th>Necessidade de Educação Especial</th>

        <th>Procedência Escolar do Ensino Médio </th>

        <th>Natureza da Escola de Proveniência</th>

        <th>Nome do Curso do Ensino Médio</th>
        <th>Média Final no Ensino Médio </th>
        <th>Financiamento dos Estudos no Ensino Médio</th>
        <th>Trabalhador</th>

    </tr>


    @foreach($candidatos as $i=>$item)
    <tr>
        <td>{{$i+1}}</td>
        <td>{{$item->nomeCompleto}}</td>
        <td>{{$item->BI}}</td>
        <td>{{$item->genero}}</td>
        <td>{{$item->idade}}</td>
        <td>{{$item->dataNac}}</td>
        <td>{{\App\Candidato::getProvincia($item->id)}}</td>
        <td>{{\App\Candidato::getMunicipio($item->id)}}</td>
        <td>Angola</td>
        <td>Regular</td>
        <td>ESPB</td>
        <td>{{\App\Curso::toString($item->curso_id)}}</td>
        <td>{{ round($item->obterMedia(1, $item->id), 2) }}</td>
        <td>{{$item->estado}}</td>
        <td>Sim</td>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            @if($item->trabalhador)
            Auto-financiamento
            @else
            Financiado por familiares
            @endif
        </td>
        <td>
        @if($item->trabalhador)
           Sim
            @else
           Não
            @endif
        </td>
  
    </tr>
    @endforeach

</table>