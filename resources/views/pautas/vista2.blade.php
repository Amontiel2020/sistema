@extends('layouts.Main')

@section('content')
<h3>Pauta de {{\App\Disciplina::toString($idDisc)}}</h3>
<h3>Curso: {{\App\Curso::toString($turma->curso_id)}}</h3>
<h3>Turma: {{$turma->identificador}}</h3>
<h3>Ano Acadêmico: {{$anoAcad}}</h3>

<a href="{{route('exportPauta',$pauta->id)}}">Exportar Excel</a>
<p class="text-right"><a href="{{route('gerarPdfPauta',$pauta->id)}}" role="button" class="btn btn-primary btn-sm">Gerar pauta</a></p>

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
            <a href="#" class="editAvalF1" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad)}}
            </a>
        </td>
        <td>
            <a href="#" class="editAvalF2" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad)}}
            </a>
        </td>
        <td>
            <a href="#" class="editAvalMAC" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",$anoAcad)}}
            </a>
        </td>
        <td>{{\App\Pauta::obterMedia($item->id,$idDisc,$anoAcad)}}</td>
        <td>
            @if(\App\Pauta::obterMedia($item->id,$idDisc,$anoAcad)!=null)
            <a href="#" class="editAvalEx1" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)}}
            </a>
            @endif
        </td>
        <td>
            @if((\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)!=null)&&(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)< 10)) 
            <a href="#" class="editAvalEx2" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)}}
                </a>
                @endif
        </td>
        <td>
            @if((\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)!=null)&&(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)< 10)) 
            <a href="#" class="editAvalEx3" data-pk="{{$pauta->id}}" data-name="{{$item->id}}">
                {{\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad)}}
                </a>
                @endif
        </td>
        <td>
            @if(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)!=null)
            {{\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)}}
            @endif

        </td>
        <td>
       
            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)>=10))
            <span class="label label-success"> Aprovado</span>
            @endif
            @if((\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)!=null)&&(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad)< 10)) <span class="label label-danger"> Reprovado</span>
                @endif
        </td>
    </tr>
    @endforeach

</table>


@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $.fn.editable.defaults.ajaxOptions = {
            type: "GET"
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.editAvalF1').editable({
            url: '{{url("avalF1/update")}}',
            source: '{{url("avalF1/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalF2').editable({
            url: '{{url("avalF2/update")}}',
            source: '{{url("avalF2/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        /*      $('.editAvalF3').editable({
                  url: '{{url("avalF3/update")}}',
                  source: '{{url("avalF3/load")}}',
                   type: 'text',
                  emptytext: 'Nota',
                  success: function(response, newValue) {
                      console.log('Updated', response)
                  }

              });*/

        $('.editAvalEx1').editable({
            url: '{{url("avalEx1/update")}}',
            source: '{{url("avalEx1/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalEx2').editable({
            url: '{{url("avalEx2/update")}}',
            source: '{{url("avalEx2/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalEx3').editable({
            url: '{{url("avalEx3/update")}}',
            source: '{{url("avalEx3/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

        $('.editAvalMAC').editable({
            url: '{{url("avalMAC/update")}}',
            source: '{{url("avalMAC/load")}}',
            type: 'text',
            emptytext: 'Nota',
            success: function(response, newValue) {
                console.log('Updated', response)
            }

        });

    });
</script>
@endsection
@stop