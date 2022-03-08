@extends('layouts.Main')

@section('content')

@if($disciplina !=null)
<h3>Disciplina:{{$disciplina->nome}}</h3>
@if($lista !=null)
@foreach($lista as $item)
<form action="{{route('avaliarEstudante')}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="idEst" value="{{ $item->id }}">
    <input type="hidden" name="idDisc" value="{{ $disciplina->id }}">
    <input type="hidden" name="anoAcad" value="{{ $anoAcad }}">
    <input type="hidden" name="idPauta" value="{{ $id }}">

    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        {{$item->nome}} {{$item->apelido}}
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Avaliação</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-1">
                        <img height="100" width="100" src="{{url('/storage/'.$item->pathImage) }}" alt="">
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">F1</label>
                            <input class="form-control" type="text" name="F1" id="F1" value="{{\App\Pauta::obterAvaliacao($item->id,$disciplina->id,'F1',$anoAcad)}}">
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">F2</label>
                            <input class="form-control" type="text" name="F2" id="F2" value="{{\App\Pauta::obterAvaliacao($item->id,$disciplina->id,'F2',$anoAcad)}}">
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">MAC</label>
                            <input class="form-control" type="text" name="MAC" id="MAC" value="{{\App\Pauta::obterAvaliacao($item->id,$disciplina->id,'MAC',$anoAcad)}}">
                        </div>

                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">Media</label>
                            <input class="form-control" type="text" name="" id="" value="{{\App\Pauta::obterMedia($item->id,$disciplina->id,$anoAcad)}}">
                        </div>
                    </div>

                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">EX1</label>
                            <input class="form-control" type="text" name="Ex1" id="Ex1">
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">Ex2</label>
                            <input class="form-control" type="text" name="Ex2" id="Ex2">
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">Ex3</label>
                            <input class="form-control" type="text" name="Ex3" id="Ex3">
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <label for="">MF</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>

            </div>
            <a href="#">
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</form>
@endforeach
@endif
@else
selecione uma disciplina
@endif
@stop