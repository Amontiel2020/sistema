				                    <div class="panel panel-green">
				                        <div class="panel-heading">
				                            Dispensas {{$departamento->identificador}}
				                            
				                        </div>
				                        <div class="panel-body">
                       
						                            <div class="table-responsive">
						                                <table class="table">
						                                    <thead>
						                                        <tr>
						                                            
						                                            <th>Mes</th>
						                                            <th>Valor</th>
                                                                    <th></th>
                                                                    <th></th>
						                                            
						                                        </tr>
						                                    </thead>
						                                    <tbody>
						                                    	@foreach($departamento->dispesas() as $dispesa)
						                                        <tr class="success">
						                                            
						                                            <td>{{$dispesa->mes}}</td>
						                                            <td>
					                                                    <input 
													  				      type="number" 
													  				      min="1"
													                      max="100"
													                      value="{{$dispesa->valor}}"
													                      id="dispesa_{{$dispesa->id}}" 
													  				      > 	

						                                            </td>

                                                                    <td width="5">
                                                                          <a href="#" 
                                                                          class="btn btn-warning btn-xs btn-update-item"
                                                                          data-href="http://192.168.10.150/dispesasDpto/update"
                                                                          data-id="{{$dispesa->id}}"

                                                                        >
                                                                            <i class="fa fa-refresh"></i>
                                                                          </a>

                                                                        
                                                                    </td>
                                                                    <td width="5">
                                                                    <form action="{{route('deleteDispesa',$dispesa->id)}}">
                                                                        <input type="hidden" name="method" value="DELETE">
                                                                    <button onclick="return confirm('Eliminar registro?')" class="btn btn-danger btn-xs">
                                                                    <i class="fa fa-trash"></i>         
                                                                    </button>
                                                                    </form>  

                                                                    </td>
						                                            
						                                        </tr>
						                                        @endforeach

						                                    </tbody>
						                                </table>
						                            </div>
						                            <!-- /.table-responsive -->

				                        </div>
				                        <div class="panel-footer">
				                            Total:
				                        </div>
				                    </div>  