@extends('layouts.Main')

@section('content')

<div class="page-header">
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Mapas IRT</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="#">
                    <div class="form-group">
                        <label for="">Mes</label>
                        <select name="mes" id="mes" class="form-control">
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ano</label>
                        <select name="ano" id="ano" class="form-control">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop