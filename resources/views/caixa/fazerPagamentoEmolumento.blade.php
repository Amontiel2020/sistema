@extends('layouts.Main')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        Pagamento de Emolumentos
    </div>
    <div class="panel-body">
        <form action="{{route('storePagamentoEmolumento')}}" method="post">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Ano Acadêmico</label>
                <select name="anoAcademico" id="anoAcademico">
                    <option value="2020" selected>2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>

            </div>
            <div class="form-group">
                <label>Estudante</label>
                {!! Form::select('estudante',$estudante,null,['id'=>'estudantePagoEmolumento','style'=>'width: 50%']) !!}
                <span class="text-danger">{{ $errors->first('estudante') }}</span>

            </div>

            <div class="form-group">
                <label>Emolumento</label>
                <select name="emolumento[]" id="emolumento" multiple="multiple" class="form-control">
                    @foreach($emolumentos as $emolumento)
                    <option value="{{$emolumento->id}}">{{$emolumento->nome}}--{{$emolumento->valor}}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('emolumento') }}</span>

            </div>

            <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>







        </form>



    </div>

</div>
@section('scripts')
<script>
(document).ready(function () {

$("#emolumento").change(function () {
 
  valor = $("#emolumento option:selected").val();


 $("#tabelaPagamentos").css("visibility", "visible");
 mes = 0;//$(this).attr("id");
 valor = "Valor do Emolumento";

 /*if (mes == 1) {
   valor = 3000;

 } else if (mes == 2) {
   valor = 15000;
 } else {
   valor = 25000
 }*/

 // valor=$('#valor').val();
 // desc="TPA";
 idEst = $("#nomeEstPagamento").text();
 ano = $("#anoEstPagamento").text();
 cantidadPagamentos = $("#cantidadPagamentos").val();;
// idEmolumento = 1;

/* if ($("#propinas").prop("checked")) {
   idEmolumento = 1;
 }*/

 desc = "Desc";
 clase = '"' + "btn btn-xs btn-danger eliminarPago" + '"';
 claseFormPago = '"' + "mostrar " + '"';
 idFormPago = '"' + "formasDePago" + '"';
 nameFormPago = "name=" + '"' + "formasDePago" + mes + "[]" + '"';
 nameBotonObs = "name=" + '"' + "obs[]" + '"';
 nameBotonObsGeral = "name=" + '"' + "obsGeral" + '"';



 multiple = '"' + "multiple" + '"';


 boton = "<button class=" + clase + ">" + "Eliminar" + "</button>"
 botonFormasPago = "<select " + "multiple=" + multiple + nameFormPago + " id=" + idFormPago + "class=" + claseFormPago + ">"
   + "<option>TPA</option>"
   + "<option>Dinheiro</option>"
   + "<option>Transferência</option>"
   + "</select>";

 botonObs = "<textarea " + nameBotonObs + ">" + "</textarea>";
 botonObsGeral = "<textarea " + nameBotonObsGeral + ">" + "</textarea>";


 //campos del formulario
 //atributos
 claseForm = '"' + "form-control" + '"';
 tipo = '"' + " text" + '"';
 tipoHidden = '"' + " hidden" + '"';

 valueInputMes = '"' + mes + '"';
 valueInputValor = '"' + valor + '"';








 inputMes = "<input type=" + tipo + " value=" + valueInputMes + " class=" + claseForm + " </>";
 inputValor = "<input type=" + tipo + " value=" + valueInputValor + " class=" + claseForm + " </>";

 //establecer valor del mes
 valorMes = "";
 if (mes == 1) {
   valorMes = "<span>1</span>" + "-->Janeiro";


 } else if (mes == 2) {
   valorMes = "<span>2</span>" + "-->Fevereiro";
 }
 else if (mes == 3) {
   valorMes = "<span>3</span>" + "-->Março";
 }
 else if (mes == 4) {
   valorMes = "<span>4</span>" + "-->Outubro";
 }
 else if (mes == 5) {
   valorMes = "<span>5</span>" + "-->Novembro";
 }
 else if (mes == 6) {
   valorMes = "<span>6</span>" + "-->Dezembro";
 }
 else if (mes == 7) {
   valorMes = "<span>7</span>" + "-->Janeiro";
 }
 else if (mes == 8) {
   valorMes = "<span>8</span>" + "-->Fevereiro";
 }
 else if (mes == 9) {
   valorMes = "<span>9</span>" + "-->Março";
 }
 else if (mes == 10) {
   valorMes = "<span>10</span>" + "-->Abril";
 }
 else if (mes == 11) {
   valorMes = "<span>11</span>" + "-->Maio";
 }
 else if (mes == 12) {
   valorMes = "<span>12</span>" + "-->Junho";
 }
 else if (mes == 0) {
  valorMes = "<span>0</span>" + "";


}


 designacao = "Emolumento";
 //Estabelecer a designação
 /*if (idEmolumento == 1 && mes == 1) {
   designacao = "Inscrição";
 } else if (idEmolumento == 1 && mes == 2) {
   designacao = "Matricula";
 } else {
   designacao = "Propinas";
 }*/


 idTaxa = " id=" + '"' + "taxa" + '"';
 tipoTaxa = " type=" + '"' + "number" + '"';


 idBtnTaxa = " id=" + '"' + "mostrarTaxa " + '"';
 classeValorTaxa = " class=" + '"' + "ocultarno" + '"';
 ValueValorTaxa = " value=" + '"' + "0" + '"';
 botonValorTaxa = "<input " + tipoTaxa + idTaxa + classeValorTaxa +ValueValorTaxa+ "/>"



 claseBotonTaxa = " class=" + '"' + "btn btn-xs btn-danger" + '"';

 botonTaxa = "<a " + claseBotonTaxa + idBtnTaxa + ">" + "Aplicar" + "</a>"
 // botonTaxa="<label"+idBtnTaxa+">Aplicar</label>"


 $('#pagamentosRealizar').append(
   "<tr><td>"
   + designacao
   + "</td><td>"
   + valorMes
   + "</td><td>"
   + valor
   + "</td><td>"
   + "<label>Semanas</label>"
   + botonValorTaxa
   + "</td><td>"
   + botonFormasPago
   + "</td><td>"
   + botonObs
   + "</td><td>"
   + botonObsGeral
   + "</td></tr>"
 );


});
});

</script>

@endsection
@stop