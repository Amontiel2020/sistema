@extends('layouts.Main')

@section('content')
<div class="page-header">
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Avaliações dos candidatos inscritos em {{\App\Curso::toString($curso_id)}}</h3>
      
        <h3>Exame de: {{$exame->nome}}</h3>

    </div>
</div>
<div class="panel-body">
    <table class="table table-bordered table-striped">

        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nome do Candidato</th>
            <th>Classificação</th>

        </tr>


        @foreach($candidatos as $i=>$item)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$item->codigo}}</td>
            <td>{{$item->nomeCompleto}}</td>
            <td>
              <!--  @if($item->obterAval($processo_id,$exame_id,$item->id))
                {{$item->obterAval($processo_id,$exame_id,$item->id)}}
                @endif
                @if(!$item->obterAval($processo_id,$exame_id,$item->id))
                <a href="#" class="editAval" data-pk="{{$exame_id}}" data-name="{{$item->id}}">
                    {{$item->obterAval($processo_id,$exame_id,$item->id)}}</a>
                @endif-->
                <a href="#" class="editAval" data-pk="{{$exame_id}}" data-name="{{$item->id}}">
                    {{$item->obterAval($processo_id,$exame_id,$item->id)}}</a>
            </td>

        </tr>
        @endforeach

    </table>

  
</div>
</div>







@section('scripts')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.editAval').editable({
            url: '{{url("aval/update")}}',
            source: '{{url("aval/load")}}',
            title: 'Actualizar',
            emptytext: 'Lançar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }
        });
    });
</script>

@endSection


@stop