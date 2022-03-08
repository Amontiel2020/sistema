@extends('layouts.Main')

@section('content')
<div class="page-header">
        <div class="row">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Estudantes Matriculados do ano acadêmico 2021</h3>

    </div>
    <div class="panel-body">

        <form action="{{route('estudantesMatriculados')}}">
            <div class="row">
                <!--  <div class=col-md-4>
                        <select name="tipo" class="form-control">
                            <option>Pesquisar por tipo</option>
                            <option>nome</option>
                            <option>apelido</option>
                            <option>curso</option>
                            <option>email</option>
                            <option>turma</option>
                        </select>
                    </div>
                    -->

                <div class=col-md-4>
                    <!-- <input type="text" class="form-control" name="buscarporEstado" value="" placeholder="Estado">-->
                    <select class="form-control" name="curso" id="curso">
                        <option value="-">Curso</option>
                        @foreach($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                        @endforeach


                    </select>
                </div>
                <div class=col-md-4>

                    <button type="submit" class="btn btn-primary" title="Pesquisar">
                        Filtrar
                    </button>
                </div>
            </div>
        </form>
        <br>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nº de Ordem</th>
                        <th>Nº do Estudante</th>
                        <th>Nome Completo</th>
                        <th>Sexo</th>
                        <th>Idade</th>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($estudantes as $i=>$estudante)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$estudante->codigo}}</td>
                        <td>{{$estudante->nome}} {{$estudante->apelido}}</td>
                        <td>{{$estudante->genero}}

                        </td>

                        <td>
                            @if($estudante->idade !=null)
                            {{$estudante->idade}}
                            @endif
                        </td>
                        <td> {{\App\Curso::toString($estudante->curso_id)}}</td>
                        <td>
                            @if($estudante->turma_id !=null)
                            {{\App\Turma::toString($estudante->turma_id)}}
                            @endif
                        </td>
                        <td>
                     
                           <!-- <a href="#" class="editInscricao"  data-value="{{$estudante->curso_id}}" data-pk="{{$estudante->curso_id}}" data-name=""> Inscrição </a>-->
                             <a href="{{ route('mostrarDiscInscricao',[$estudante->id,1,1])}}">Fazer Inscriçao</a>
                      
                        </td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.table-responsive -->
    </div>


</div>


@section('scripts')
<script>
    $(document).ready(function() {
        $.fn.editable.defaults.ajaxOptions = {
            type: "GET"
        };

        $('.editInscricao').editable({
            url: '{{url("inscricao/update")}}',
            source: '{{url("inscricao/load")}}',
            type: 'checklist',
            emptytext: 'fazer Inscrição ',

           /* success: function(response, newValue) {
                console.log('Updated', response)
                alert(response);
            }*/

        });
     /*   $(function() {
            $('.editInscricao').editable({
                value: [2, 3],
                type: 'checklist',
                source: '{{url("inscricao/load")}}'
            });
        });*/
    });
</script>

@endsection
@stop