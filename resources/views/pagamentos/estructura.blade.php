                                       

                                        <td @if ($estudante->pago($estudante->id,$mesR,$ano)=='true')
                                                class="pago"
                                              @endif
                                              @if ($estudante->pago($estudante->id,$mesR,$ano)=='false')
                                                class="naoPago"
                                              @endif

                                              >
                                            @if ($estudante->pago($estudante->id,$mesR,$ano)=='true')
                                                <span>pago</span>
                                             @endif
                                             @if ($estudante->pago($estudante->id,$mesR,$ano)=='false')
                                           
                                                <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#{{$estudante->id}}1">
                                                  <i class="fa fa-usd"></i>{{$mesR}}
                                                </button>

                                                        <div class="modal fade" id="{{$estudante->id}}1" tabindex="-1" role="dialog" aria-labelledby="firefoxModalLabel" aria-hidden="false">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="firefoxModalLabel">Pagamento</h4>
                                                              </div>
                                                              <div class="modal-body">
                                                              <form action="{{route('confirmarPagamento')}}">
                                                                <input type="hidden" name="estudante" value="{{$estudante->id}}">
                                                                <input type="hidden" name="mes" value="{{$mesR}}">
                                                                <input type="hidden" name="ano" value="{{$ano}}">
                                                                <p>Estudante:{{$estudante->nome}}</p>
                                                                <p>Mes:{{$mesR}}</p>
                                                                <p>Ano:{{$ano}}</p>


                                                                <p>Valor:$...</p>   
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>    
                                                      @endif
                                                    </td>  