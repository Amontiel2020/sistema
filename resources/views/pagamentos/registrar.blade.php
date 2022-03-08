@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Filtros
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" action="{{route('registrarPagamento')}}">
                              <label>Turma</label>
                              <select class="form-control" name="turma">
                                @foreach($turmas as $item)
                                <option value="{{$turma->id}}"
                                  @if($turma->id==$turmaSelecionada->id) selected @endif
                                  >{{$item->identificador}}</option>
                                @endforeach
                              </select>

                              <label>Ano</label>
                              <select class="form-control" name="ano">
                                <option value="2018"
                                @if($ano==2018) selected @endif
                                >2018
                                </option>
                                <option value="2019"
                                @if($ano==2019) selected @endif
                                >2019</option>
                                <option value="2020"
                                @if($ano==2020) selected @endif
                                >2020</option>
                              </select>
                              <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form> 
                        </div>
                    </div>

@if(isset($ano))

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Propinas
                        </div>

                        <div class="panel-body">
<div class="panel panel-default">
                        <div class="panel-heading">
                          Ano:  {{$ano}}
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Estudante</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                            <th>8</th>
                                            <th>9</th>
                                            <th>10</th>
                                            <th>11</th>
                                            <th>12</th>
                                        </tr>                                      
                                    </thead>
                                    <tbody>                                      
                                      @foreach($estudantes as $estudante)
                                        <tr>
                                            <td width="10">
                                              <a href="#" class="btn btn-primary btn-xs">
                                              <i class="fa fa-pencil-square"></i>       
                                              </a>
                                            </td>
                                            <td>{{$estudante->nome}}</td>
                                              @include('pagamentos.estructura',['mesR' => '1'])
                                              @include('pagamentos.estructura',['mesR' => '2'])



                                                </tr>
                                      @endforeach

                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
  @else
  <h3>Sem resultados</h3>
  @endif

@stop