@extends('layouts.Main')

@section('content')


<div class="page-header">

</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Exames admissão</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{route('addExameToProcesso')}}" class="form-inline" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $item}}">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="curso" id="curso">
                            @foreach($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$professores->isEmpty())


                    <div class="form-group">
                        <select class="form-control" name="professor" id="professor">

                            @foreach($professores as $prof)
                            <option value="{{$prof->id}}">{{$prof->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Registrar Exame</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped table-condensed">
            <tr>
                <th>Disciplina</th>
                <th>Curso</th>
                <th>Professor</th>
                <th>Local</th>
                <th>Data</th>
                <th>Avaliações</th>
                <th>Elimnar</th>
            </tr>
            @foreach($exames as $exame)
            <tr>
                <td>{{$exame->nome}}</td>
                <td>{{\App\Curso::toString($exame->curso_id)}}</td>
                <td>

                </td>
                 
                <td>
                    <a href="#" class="editLocal" data-pk="{{$exame->id}}">

                </td>
                <td>
                    <a href="#" class="editData" data-pk="{{$exame->id}}">

                </td>
                <td>
                    <a role="button" class="btn btn-success btn-xs" href="{{route('listarPautaExameCandidatura',[$item,$exame->id,$exame->curso_id])}}">Ver</a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm" href="{{route('eliminar_axame_candidatura',$exame->id)}}">Eliminar</a>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>




@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    //actualiza documentos do processo
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.xedit').editable({
            url: '{{url("documentos/update")}}',
            title: 'Actualizar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }
        });

    });
    //actualizar corte avaliativo
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.editLocal').editable({
            url: '{{url("exameAdmissao/updateLocal")}}',
            title: 'Actualizar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }
        });
        $('.editData').editable({
            url: '{{url("exame/update")}}',
            title: 'Actualizar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }
        });


        $('.editProfessor').editable({
            url: '{{url("prof/update")}}',
            source: '{{url("prof/load")}}',
            type: 'select',
            emptytext: 'Definir professor',
            params: function(params) {
                //originally params contain pk, name and value
                params['X-CSRF-TOKEN'] = '{{csrf_token()}}';
                return params;
            }

        });




    });
</script>

<!-- <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script> -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea.description',
        width: 1024,
        height: 300,
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>

<script>
    $(document).ready(function() {

        $("#addExame").validate({

            rules: {
                nome: {
                    /*  required: true,*/
                    maxlength: 50,
                    //lettersonly: true 
                },



            },
            messages: {

                nome: {
                    maxlength: "O nome do exame não pode passar de 50 caracteres.",
                },

            },
        })

    });
</script>
@endSection

@stop