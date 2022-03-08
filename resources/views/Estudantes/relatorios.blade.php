@extends('layouts.Main')

@section('content')
<div class="page-header">

</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Relatórios</h3>
    </div>
    <div class="panel-body">
       <ol>
           <li> <a href="{{route('pdfEstRecEx3')}}">Lista estudantes recursos e ex. especial</a></li>
       </ol>
    </div>
</div>

@stop