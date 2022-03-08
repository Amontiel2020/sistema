@extends('layouts.Main')

@section('content')
<div class="container">
<div class="page-header">
   <div class="row">
       <div class="col-md-6">
        <h5>Lista de Usuarios</h5>
       </div>
       <div class="col-md-6" align="right">
           <a href="{{route('inserirUsuarios')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Inserir Usuario</a>
       </div>

   </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        Usuarios({{count($lista)}})
    </div>
    <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Apelidos</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Activo</th>
                    <th>Endereço</th>
                    <th></th>
                    <th></th>
                    
                </tr>
                
            @foreach($lista as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->user}}</td>
                    
                    <td>
                        @foreach($item->roles()->get() as $role)
                        {{$role->name}}
                        @endforeach
                    </td>
                    <td>{{$item->active}}</td>
                    <td>{{$item->address}}</td>
                 <td width="10"><a href="{{route('editarUsuarios',$item->id)}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square"></i>         
                        </a>

                    </td>
                    <td width="10">
                        <form action="{{route('eliminarUsuarios',$item->id)}}" method="DELETE">
                        
                        <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>         
                        </button>
                        </form>

                    </td>


                </tr>
            @endforeach
            </table>
         
    </div>

</div>
</div>






@stop