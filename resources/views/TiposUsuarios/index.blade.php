@extends('layouts.Main')

@section('content')
<div class="container">
	

    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                       <h5>Lista de Tipos de Usuarios</h5>
            </div>
            <div class="col-md-6" align="right">
                 <a href="{{route('inserirTiposUsuarios')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Inserir Tipo Usuario</a>
            </div>
        </div>
 
    </div>

 <div class="panel panel-primary">
     <div class="panel-heading">
         Tipos de Usuarios({{count($lista)}})
     </div>
     <div class="panel-body">
         <table class="table">
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th></th>
        <th></th>
    </tr>
    
@foreach($lista as $item)
    <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->description}}</td>
            <td width="10"><a href="{{route('editarTiposUsuarios',$item->id)}}" class="btn btn-sm btn-primary">
            <i class="fa fa-pencil-square"></i>         
            </a>

        </td>
        <td width="10">
            <form action="{{route('eliminarTiposUsuarios',$item->id)}}">
                <input type="hidden" name="method" value="DELETE">
            <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i>         
            </button>
            </form>

        </td>


    </tr>
@endforeach
</table>
<div align="center">{{$lista->render()}}</div>
     </div>
 </div>


</div>

@stop