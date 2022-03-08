@extends('layouts.Main')




@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="text-center">Mapa de controlo de propinas 2020/2021 da turma {{$turma->identificador}}</h3>

   </div>
   <div class="panel-body">
      <a href="{{route('pdfMapaPagamentos',[$turma->id,$ano])}}">Exportar PDF</a>
      <div class="table-responsive">


         <table class="table table-hover  table-bordered">
            <thead>

               <tr>
                  <th>#</th>
                  <th>Nome e Apelidos</th>
                  <th>Março 2020</th>
                  <th>Outubro 2020</th>
                  <th>Novembro 2020</th>
                  <th>Dezembro 2020</th>
                  <th>Janeiro 2021</th>
                  <th>Fevereiro 2021</th>
                  <th>Março 2021</th>
                  <th>Abril 2021</th>
                  <th>Maio 2021</th>
                  <th>Junho 2021</th>
                  <th>Total</th>
                  <th>Total Taxa</th>
                  <th>Total Geral</th>

               </tr>
            </thead>
            <tbody>
               @foreach($estudantes as $index=>$estudante )
               <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$estudante->nome}}{{" "}}{{$estudante->apelido}}</td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)!=null)
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,3,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa,2,',','.') }}
                     
                     </span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,4,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,5,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,6,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,7,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,8,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,9,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,10,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa}}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,11,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)==null) class="bg-danger" @endif>
                     @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano))
                     {{number_format((App\Pagamento::pagamentoMesAno($estudante,12,$ano))->valor,2,',','.') }}
                     @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa !=null)
                     <span class="badge badge-pill badge-danger">Taxa{{number_format(App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa,2,',','.') }}</span>
                     @endif
                     @else
                     --
                     @endif
                  </td>
                  <td class="bg-danger">
                     {{number_format((App\Pagamento::totalPagamentosAno($estudante,$ano)),2,',','.') }}
                  </td>
                  <td class="bg-danger">
                     {{number_format((App\Pagamento::totalPagamentosaxaAno($estudante,$ano)),2,',','.') }}
                  </td>
                  <td class="bg-danger">
                     {{number_format((App\Pagamento::totalPagamentosAno($estudante,$ano))+ (App\Pagamento::totalPagamentosaxaAno($estudante,$ano)),2,',','.') }}
                  </td>
               </tr>

               @endforeach
            </tbody>
         </table>

      </div>

   </div>
</div>











@stop