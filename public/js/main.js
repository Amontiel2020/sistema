//Evento para cambiar as dispesas dos departamentos

$(function () {

  $('.btn-update-item').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var href = $(this).data('href');
    var cantidad = $('#dispesa_' + id).val();

    var href2 = href + "/" + id + "/" + cantidad;
    //alert(href2);


    window.location.href = href2;

  });


});

// Evento Hover para elementos de meses a pagar
$(function () {
  $('.proximoPagar').hover(

    function () {
      $(this).addClass('hover').css("cursor", "progress");
    },


    function () {
      $(this).removeClass('hover').css("cursor", "auto");
    });


});

//evento para fazer pagamento directo de un mes

$(function () {

  $('.btn-fazer-pagamento').on('click', function (e) {

    e.preventDefault();
    var nome = $(this).data('nome');
    var mes = $(this).data('mes');
    var id = $(this).data('id');

    // var href=$(this).data('href');
    $('#nomeEstudante').val(nome);
    $('#idEstudante').val(id);
    $('#mesX').val(mes);
    //alert(mes);
    //  var cantidad=$('#dispesa_'+id).val();

    //  var href2=href+"/"+id+"/"+cantidad;
    //alert(href2);


    // window.location.href=href2;

  });


});


//evento para mostrar la ficha de pagamentos de un estudiante

$(function () {

  $('.btn-fichaEstudante').on('click', function (e) {

    e.preventDefault();
    var nome = $(this).data('nome');
    var apelido = $(this).data('apelido');
    var curso = $(this).data('curso');
    var nomeApelidos = nome + apelido;

    // var href=$(this).data('href');
    $('#fichaNome').val(nomeApelidos);
    //$('#fichaApelido').val(apelido);
    $('#fichaCurso').val(curso);
    // alert(nome);
    //  var cantidad=$('#dispesa_'+id).val();

    //  var href2=href+"/"+id+"/"+cantidad;
    //alert(href2);


    // window.location.href=href2;

  });


});



//select dinamico de Turmas e estudantes
$(function () {

  $("#turmaDinamico").change(function (event) {
    // alert($(this).val());
    $.get("estudantes/" + $(this).val() + "", function (response, state) {
      $("#estudanteDinamico").empty();
      for (i = 0; i < response.length; i++) {
        $("#estudanteDinamico").append("<option value='" + response[i].id + "'>" + response[i].nome + "</option>");
      }
    });
  });

});


//select dinamico de meses pagos
$(function () {

  $("#selectFazerPagamento").change(function (event) {
    ano = $('#valorPagamento').val();
    url = "mesesValidos/" + $(this).val() + "/" + ano + "";
    // alert(url);
    // alert(ano);
    $.get(url, function (response, state) {
      $("#mesesFazerPagamento").empty();
      for (i = 0; i < response.length; i++) {
        $("#mesesFazerPagamento").append("<option disabled value='" + response[i].mes + "'>" + response[i].mes + "(pago)" + "</option>");
      }
      for (i = response.length + 1; i <= 12; i++) {
        $("#mesesFazerPagamento").append("<option value='" + i + "'>" + i + "</option>");
      }
    });
  });

});

//pagamentos por turma seleccionada
$(document).ready(function () {


  $("#selectTurma").change(function (event) {
    //alert('aqui');
    consulta = $(this).val();

    url = "busquedaTurma/" + consulta + "";
    // requestInfo="busqueda/";

    // url="http://192.168.10.150/propinasGeral/";
    // alert(url);
    if (consulta == "") {
      $("#tbodyResultado").empty();
    }


    $.getJSON(url, function (response, state) {
      $("#tbodyResultado").empty();
      nomeActual = "";
      $.each(response, function (k, v) {
        meses = buscar(v.nome, response);
        cadena = "";
        cadena2 = "";
        for (i = 0; i < meses.length; i++) {
          //cadena+=" "+meses[i]+" ";
          classe = '"' + "col-md-1 test" + '"';
          classe2 = '"' + "col-md-1 sinPagar" + '"';
          cadena += "<div class=" + classe + ">" + meses[i] + "</div>";
        }

        for (j = meses.length + 1; j <= 12; j++) {
          cadena2 += "<div class=" + classe2 + ">" + j + "</div>";
        }



        if (nomeActual != v.nome) {
          nomeActual = v.nome;
          classe2 = '"' + "col-md-12" + '"';
          classe3 = '"' + "col-md-6" + '"';
          classeImg = '"' + "fa fa-user fa-5x" + '"';
          classeRow = '"' + "row" + '"';
          ancho = '"' + "40" + '"';
          caminho = "'" + "/storage/" + "'";
          imagen = "<img src=/storage/" + v.pathImage + "></img>";
          // alert(v.pathImage);
          ruta = "propinas/fichaPagamento/" + v.id;
          link = "<a href=" + '"' + ruta + '"' + ">" + v.nome + "</a>";
          //   $("#tbodyResultado").append("<tr><td><div class="+classeRow+"><div class="+classe3+"><i class="+classeImg+"></i>"+"</div>"+"<div class="+classe3+">"+imagen+v.nome+"</div>"+"</div>"+"</td> <td><div class="+classeRow+"><div class="+classe2+">"+cadena+cadena2+"</div></div></td></tr>");
          $("#tbodyResultado").append("<tr><td><div class=" + classeRow + "><div class=" + classe3 + "><i class=" + classeImg + "></i>" + "</div>" + "<div class=" + classe3 + ">" + link + "</div>" + "</div>" + "</td> <td><div class=" + classeRow + "><div class=" + classe2 + ">" + cadena + cadena2 + "</div></div></td></tr>");

          //  $("#tbodyResultado").append("<td><div class="+classeRow+"><div class="+classe2+">"+cadena+"</div></div></td></tr>");
        }






      });



    });

  });
});



//pagamentos por estudiante digitado
$(document).ready(function () {


  $("#busqueda").keyup(function (event) {
    //alert('aqui');
    consulta = $(this).val();

    url = "busqueda/" + consulta + "";
    // requestInfo="busqueda/";

    // url="http://192.168.10.150/propinasGeral/";
    // alert(url);
    if (consulta == "") {
      $("#tbodyResultado").empty();
    }


    $.getJSON(url, function (response, state) {
      $("#tbodyResultado").empty();
      nomeActual = "";
      $.each(response, function (k, v) {
        meses = buscar(v.nome, response);
        cadena = "";
        cadena2 = "";
        for (i = 0; i < meses.length; i++) {
          //cadena+=" "+meses[i]+" ";
          classe = '"' + "col-md-1 test" + '"';
          classe2 = '"' + "col-md-1 sinPagar" + '"';
          cadena += "<div class=" + classe + ">" + meses[i] + "</div>";
        }

        for (j = meses.length + 1; j <= 12; j++) {
          cadena2 += "<div class=" + classe2 + ">" + j + "</div>";
        }



        if (nomeActual != v.nome) {
          nomeActual = v.nome;
          classe2 = '"' + "col-md-12" + '"';
          classe3 = '"' + "col-md-6" + '"';
          classeImg = '"' + "fa fa-user fa-5x" + '"';
          classeRow = '"' + "row" + '"';
          ancho = '"' + "40" + '"';
          ruta = "propinas/fichaPagamento/" + v.id;
          rutaEditar = "estudantes/editar/" + v.id;
          pathImage = "../imagenes-perfil/" + v.pathImage;
          imagem = "<img src=" + '"' + pathImage + '"' + " width=" + '"' + "100px" + '"' + " height=" + '"' + "100px" + '"' + '"' + " />";

          // {{url('/storage/'.$item->pathImage) }}

          link = "<a href=" + '"' + ruta + '"' + ">" + v.nome + "</a>";
          linkEditar = "<br><a href=" + '"' + rutaEditar + '"' + ">" + "editar" + "</a>";

          //link="<a href="+ruta+">"+v.nome+"</a>";
          $("#tbodyResultado").append("<tr><td><div class=" + classeRow + "><div class=" + classe3 + ">" + imagem + "</div>" + "<div class=" + classe3 + ">" + link + "</div>" + "</div>" + "</td> <td><div class=" + classeRow + "><div class=" + classe2 + ">" + cadena + cadena2 + "</div></div></td></tr>");

          //  $("#tbodyResultado").append("<td><div class="+classeRow+"><div class="+classe2+">"+cadena+"</div></div></td></tr>");
        }






      });



    });

  });
});

//select turma - estudantes dinamico 
///////////////////////////////////////////////select dinamico///////////////////////////////////////////////////////////////
$(document).ready(function () {


  $("#turma").change(function (event) {

    consulta = $(this).val();

    url = "estudantesTurma/" + consulta + "";
    // requestInfo="busqueda/";

    // url="http://192.168.10.150/propinasGeral/";
    // alert(url);
    if (consulta == "") {
      $("#selectEstudantes").empty();
    }


    $.getJSON(url, function (response, state) {
      $("#selectEstudantes").empty();

      $.each(response, function (k, v) {
        id = '"' + v.id + '"';
        $("#selectEstudantes").append("<option value=" + id + ">" + v.nome + "</option>");
      });



    });

  });
});
///////////////////////////////////////////////// end select dinamico//////////////////////////////////////////////



//////////////////////////////mostra Conta Corrente do Estudante///////////////////////////////////////////////////
$(document).ready(function () {


  $mesesCargados = false;

  // $("#selectEstudantes").change(function (event) {
  $("#estudante").change(function (event) {

    $("#divMainPagamentos").css("visibility", "visible");
    id = $(this).val();
    url = "estudanteDadoID/" + id + "";


    ano = $("#anoPagamento option:selected").val();

    url2 = "pagamentosEstudantes/" + id + "/" + ano + "";



    idValueInscricao = " id=" + '"' + "idValueInscricao" + '"';
    idValueMatricula = " id=" + '"' + "idValueMatricula" + '"';
    idValueMarco = " id=" + '"' + "idValueMarco" + '"';
    idValueOutubro = " id=" + '"' + "idValueOutubro" + '"';
    idValueNovembro = " id=" + '"' + "idValueNovembro" + '"';
    idValueDezembro = " id=" + '"' + "idValueDezembro" + '"';

    valueInscricao = " value=" + '"' + "inscricao" + '"';
    valueMatricula = " value=" + '"' + "matricula" + '"';
    valueMarco = " value=" + '"' + "marco" + '"';
    valueOutubro = " value=" + '"' + "outubro" + '"';
    valueNovembro = " value=" + '"' + "novembro" + '"';
    valueDezembro = " value=" + '"' + "dezembro" + '"';





    claseTest = " class=" + '"' + "elementoSelect" + '"';
    if ($mesesCargados == false) {
      $('#emolumento').append("<option" + valueInscricao + idValueInscricao + " >Inscrição</option>");
      $('#emolumento').append("<option" + valueMatricula + idValueMatricula + " >Matricula</option>");
      $('#emolumento').append("<option" + valueMarco + idValueMarco + " >p.Março</option>");
      $('#emolumento').append("<option" + valueOutubro + idValueOutubro + " >p.Outubro</option>");
      $('#emolumento').append("<option" + valueNovembro + idValueNovembro + " >p.Novembro</option>");
      $('#emolumento').append("<option" + valueDezembro + idValueDezembro + " >p.Dezembro</option>");
      $mesesCargados = true;
    }












    /****************************carga la imagen e pagamantos feitos********************************************/
    $.getJSON(url2, function (response, state) {
      $("#foto").empty();
      $("#pagamentosFeitos").empty();
      $("#nomeEstPagamento").empty();
      $("#anoEstPagamento").empty();
      $("#nomeEstudante").empty();
      $("#pagamentosRealizar").empty();
      $("#cursoEst").empty();
      $("#bi").empty();
      $("#estadoConta").empty();



      $("#tabelaPagamentos").css("visibility", "hidden");



      $('#panelPagamentos button').attr("disabled", false);
      $('#panelPagamentos button').attr("class", "");
      $('#panelPagamentos button').addClass("btn btn-xs btn-default btn-pagamento");

      $('#idValueInscricao').attr('disabled', false);
      $('#idValueMatricula').attr('disabled', false);
      $('#idValueMarco').attr('disabled', false);
      $('#idValueOutubro').attr('disabled', false);
      $('#idValueNovembro').attr('disabled', false);
      $('#idValueDezembro').attr('disabled', false);





      imagenInserida = false;
      designacao = "";
      valorMes = "";


      $("#nomeEstPagamento").append("<b>" + id+"  "+ "</b>");
      $("#anoEstPagamento").append("<b>" + ano + "</b>");

      ruta = "estadoConta/" + id + "/" + ano + "";
      link = "<a href=" + '"' + ruta + '"' + ">" + "Estado de Conta" + "</a>";
      $("#estadoConta").append(link);

      propMarco = false;
      propOutubro = false;
      propNovembro = false;
      propDezembro = false;
      propJaneiro = false;
      propFevereiro = false;
      propMarco2 = false;
      propAbril = false;
      propMaio = false;
      propJunho = false;
      propJulho = false;




      restablecerTextoBotones();

      $.each(response, function (k, v) {

        if (!imagenInserida) {
          pathImage = "../imagenes-perfil/" + v.pathImage;
          imagem = "<img src=" + '"' + pathImage + '"' + " width=" + '"' + "200px" + '"' + " height=" + '"' + "200px" + '"' + '"' + " />";
          $("#foto").append(imagem);
          $("#nomeEstudante").append(" " + v.nome + " " + v.apelido+" ");
          $("#cursoEst").append(" " + v.curso);
          $("#bi").append(" " + v.BI);


          imagenInserida = true;
        }
        if (v.emolumento_id == 1 && v.mes == 1) {
          designacao = "Inscrição";
        } else if (v.emolumento_id == 1 && v.mes == 2) {
          designacao = "Matricula";
        } else {
          designacao = "Propinas";
        }
        //  mes = v.mes;




        if (v.emolumento_id == 1 && v.mes == 1) {
          valorMes = "Janeiro";
          $('.btn-pagamento[id=1]').removeClass("btn-default");
          $('.btn-pagamento[id=1]').addClass("btn-success");
          $('.btn-pagamento[id=1]').attr('disabled', "true");
          $('#idValueInscricao').attr('disabled', "true");


        } else if (v.emolumento_id == 1 && v.mes == 2) {
          valorMes = "Fevereiro";
          $('.btn-pagamento[id=2]').removeClass("btn-default");
          $('.btn-pagamento[id=2]').addClass("btn-success");
          $('.btn-pagamento[id=2]').attr('disabled', "true");
          $('#idValueMatricula').attr('disabled', "true");

        }
        else if (v.emolumento_id == 1 && v.mes == 3) {
          valorMes = "Março";
          $('.btn-pagamento[id=3]').removeClass("btn-default");
          $('.btn-pagamento[id=3]').addClass("btn-success");
          $('.btn-pagamento[id=3]').attr('disabled', "true");
          $('#idValueMarco').attr('disabled', "true");
          propMarco = true;

        }
        else if (v.emolumento_id == 1 && v.mes == 4) {
          valorMes = "Outubro";
          $('.btn-pagamento[id=4]').removeClass("btn-default");
          $('.btn-pagamento[id=4]').addClass("btn-success");
          $('.btn-pagamento[id=4]').attr('disabled', "true");
          $('#idValueOutubro').attr('disabled', "true");
          propOutubro = true;

        }
        else if (v.emolumento_id == 1 && v.mes == 5) {
          valorMes = "Novembro";
          $('.btn-pagamento[id=5]').removeClass("btn-default");
          $('.btn-pagamento[id=5]').addClass("btn-success");
          $('.btn-pagamento[id=5]').attr('disabled', "true");
          $('#idValueNovembro').attr('disabled', "true");
          propNovembro = true;

        }
        else if (v.emolumento_id == 1 && v.mes == 6) {
          valorMes = "Dezembro";
          $('.btn-pagamento[id=6]').removeClass("btn-default");
          $('.btn-pagamento[id=6]').addClass("btn-success");
          $('.btn-pagamento[id=6]').attr('disabled', "true");
          $('#idValueDezembro').attr('disabled', "true");
          propDezembro = true;


        }
        else if (v.emolumento_id == 1 && v.mes == 7) {
          valorMes = "Janeiro";
          $('.btn-pagamento[id=7]').removeClass("btn-default");
          $('.btn-pagamento[id=7]').addClass("btn-success");
          $('.btn-pagamento[id=7]').attr('disabled', "true");
         propJaneiro = true;
        }
        else if (v.emolumento_id == 1 && v.mes == 8) {
          valorMes = "Fevereiro";
          $('.btn-pagamento[id=8]').removeClass("btn-default");
          $('.btn-pagamento[id=8]').addClass("btn-success");
          $('.btn-pagamento[id=8]').attr('disabled', "true");
         propFevereiro = true;
        }
        else if (v.emolumento_id == 1 && v.mes == 9) {
          valorMes = "Março";
          $('.btn-pagamento[id=9]').removeClass("btn-default");
          $('.btn-pagamento[id=9]').addClass("btn-success");
          $('.btn-pagamento[id=9]').attr('disabled', "true");
         propMarco2 = true;
        }
        else if (v.emolumento_id == 1 && v.mes == 10) {
          valorMes = "Abril";
          $('.btn-pagamento[id=10]').removeClass("btn-default");
          $('.btn-pagamento[id=10]').addClass("btn-success");
          $('.btn-pagamento[id=10]').attr('disabled', "true");
         propAbril = true;
        }
        else if (v.emolumento_id == 1 && v.mes == 11) {
          valorMes = "Maio";
          $('.btn-pagamento[id=11]').removeClass("btn-default");
          $('.btn-pagamento[id=11]').addClass("btn-success");
          $('.btn-pagamento[id=11]').attr('disabled', "true");
        }
        else if (v.emolumento_id == 1 && v.mes == 12) {
          valorMes = "Junho";
          $('.btn-pagamento[id=12]').removeClass("btn-default");
          $('.btn-pagamento[id=12]').addClass("btn-success");
          $('.btn-pagamento[id=12]').attr('disabled', "true");
        }







        $("#pagamentosFeitos").append("<tr><td>" + designacao + "</td><td>" + valorMes + "</td><td>" + v.valor + "</td><td>" + v.created_at + "</td><td>" + v.obs + "</td></tr>");

      });

 

   /*  if (propMarco == false) {
        diff=calcularDiferenciaDias(5,12,2020);
      
        if (diff > 0) {
          $('.btn-pagamento[id=3]').removeClass("btn-default");
          $('.btn-pagamento[id=3]').addClass("btn-danger");
          $(".btn-pagamento[id=3]").html('p.Março '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }

      if (propOutubro == false) {
        diff=calcularDiferenciaDias(5,11,2020);
       
        if (diff > 0) {
          $('.btn-pagamento[id=4]').removeClass("btn-default");
          $('.btn-pagamento[id=4]').addClass("btn-danger");
          $(".btn-pagamento[id=4]").html('p.Out '+'<span class="badge badge-light">'+diff+'</span>');
        }
      }

      if (propNovembro == false) {
        diff=calcularDiferenciaDias(5,12,2020);
        if (diff > 0) {
          $('.btn-pagamento[id=5]').removeClass("btn-default");
          $('.btn-pagamento[id=5]').addClass("btn-danger");
          $(".btn-pagamento[id=5]").html('p.Nov '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
      if (propDezembro == false) {
        diff=calcularDiferenciaDias(5,1,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=6]').removeClass("btn-default");
          $('.btn-pagamento[id=6]').addClass("btn-danger");
          $(".btn-pagamento[id=6]").html('p.Dez '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
      if (propJaneiro == false) {
        diff=calcularDiferenciaDias(5,2,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=7]').removeClass("btn-default");
          $('.btn-pagamento[id=7]').addClass("btn-danger");
          $(".btn-pagamento[id=7]").html('p.Fev '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
      if (propFevereiro == false) {
        diff=calcularDiferenciaDias(5,3,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=8]').removeClass("btn-default");
          $('.btn-pagamento[id=8]').addClass("btn-danger");
          $(".btn-pagamento[id=8]").html('p.Mar '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
    
     if (propMarco2 == false) {
        diff=calcularDiferenciaDias(5,4,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=9]').removeClass("btn-default");
          $('.btn-pagamento[id=9]').addClass("btn-danger");
          $(".btn-pagamento[id=9]").html('p.Abril '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
    
     if (propAbril == false) {
        diff=calcularDiferenciaDias(5,5,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=10]').removeClass("btn-default");
          $('.btn-pagamento[id=10]').addClass("btn-danger");
          $(".btn-pagamento[id=10]").html('p.Maio '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
    
         if (propMaio == false) {
        diff=calcularDiferenciaDias(5,6,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=11]').removeClass("btn-default");
          $('.btn-pagamento[id=11]').addClass("btn-danger");
          $(".btn-pagamento[id=11]").html('p.Junho '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }
             if (propJunho == false) {
        diff=calcularDiferenciaDias(5,7,2021);
        if (diff > 0) {
          $('.btn-pagamento[id=12]').removeClass("btn-default");
          $('.btn-pagamento[id=12]').addClass("btn-danger");
          $(".btn-pagamento[id=12]").html('p.Julho '+'<span class="badge badge-light">'+Math.round(diff/7)+'</span>');
        }
      }

 /*     if (propDezembro == false) {
        if (diff > 1) {
          $('.btn-pagamento[id=3]').removeClass("btn-default");
          $('.btn-pagamento[id=3]').addClass("btn-danger");
        }
      }*/



    });
    /*************************fin de carga imagen e pagamentos feitos******************************************* */




  });
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function calcularDiferenciaDias(dia, mes,ano){
     //calcular diferencia de dias 
     var oneMinute = 60 * 1000
     var oneHour = oneMinute * 60
     var oneDay = oneHour * 24
     var today = new Date()
     var nextXmas = new Date()
     nextXmas.setMonth(mes)
     nextXmas.setYear(ano)
     nextXmas.setDate(dia)

     var nextXmas2 = new Date()
     nextXmas2.setMonth(mes+1)
     nextXmas2.setYear(ano)
     nextXmas2.setDate(dia)
     /*  if (today.getMonth() == 9 && today.getDate() > 10) {
         nextXmas.setFullYear(nextXmas.getFullYear() + 1)
       }*/
     var diff = nextXmas2.getTime()- nextXmas.getTime();
     diff = Math.floor(diff / oneDay);

     return diff;
}

 function restablecerTextoBotones(){
  $(".btn-pagamento[id=1]").html('Inscrição');
  $(".btn-pagamento[id=2]").html('Matricula');
  $(".btn-pagamento[id=3]").html('p.Março');
  $(".btn-pagamento[id=4]").html('p.Outubro');
  $(".btn-pagamento[id=5]").html('p.Novembro');
  $(".btn-pagamento[id=6]").html('p.Dezembro');
  $(".btn-pagamento[id=7]").html('p.Janeiro');
  $(".btn-pagamento[id=8]").html('p.Fevereiro');
  $(".btn-pagamento[id=9]").html('p.Março');
  $(".btn-pagamento[id=10]").html('p.Abril');
  $(".btn-pagamento[id=11]").html('p.Maio');
  $(".btn-pagamento[id=12]").html('p.Junho');



 }

//

function buscar(nome, resp) {
  resultado = [];

  $.each(resp, function (k, v) {
    if (v.nome == nome) {
      resultado.push(v.valor);
    }

  });

  return resultado;

}

function pagamentos(id, ano) {
  var resultado = [];

  $(document).ready(function () {

    url = "pagamentosEstudantes/" + id + "/" + ano;


    $.getJSON(url, function (response, state) {

      $.each(response, function (k, v) {

        resultado.push(v.valor);

      });

    });
  });


  return resultado;
}


$(document).ready(function () {

  $('.btn-pagamento').click(function () {
    $("#tabelaPagamentos").css("visibility", "visible");
    mes = $(this).attr("id");
    valor = 0;

    if (mes == 1) {
      valor = 3000;

    } else if (mes == 2) {
      valor = 15000;
    } else {
      valor = 25000
    }

    // valor=$('#valor').val();
    // desc="TPA";
    idEst = $("#nomeEstPagamento").text();
    ano = $("#anoEstPagamento").text();
    cantidadPagamentos = $("#cantidadPagamentos").val();;
    idEmolumento = "";

    if ($("#propinas").prop("checked")) {
      idEmolumento = 1;
    }

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


    designacao = "";
    //Estabelecer a designação
    if (idEmolumento == 1 && mes == 1) {
      designacao = "Inscrição";
    } else if (idEmolumento == 1 && mes == 2) {
      designacao = "Matricula";
    } else {
      designacao = "Propinas";
    }


    idTaxa = " id=" + '"' + "taxa" + '"';
    tipoTaxa = " type=" + '"' + "number" + '"';
  
    idValorTaxa = " id=" + '"' + "valor_taxa" + '"';
    tipoValorTaxa = " type=" + '"' + "text" + '"';


    idBtnTaxa = " id=" + '"' + "mostrarTaxa " + '"';
    classeValorTaxa = " class=" + '"' + "ocultarno" + '"';
    ValueValorTaxa = " value=" + '"' + "0" + '"';
    botonValorTaxa = "<input " + tipoTaxa + idTaxa + classeValorTaxa +ValueValorTaxa+ "/>"
    botonValorTaxa2 = "<input " + tipoValorTaxa + idValorTaxa + "/>"




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
      + botonValorTaxa2
      + "</td><td>"
      + botonFormasPago
      + "</td><td>"
      + botonObs
      + "</td><td>"
      + botonObsGeral
      + "</td></tr>"
    );
    // mes=$('#fecha').val();

  });

});




/*****accion para enviar los datos de pagamentos al controlador */
jQuery(document).ready(function () {
  jQuery('#registrarPagamentos').on('click', function (e) {


    idEst = $("#nomeEstPagamento").text();
    ano = $("#anoEstPagamento").text();
    var idEmolumento;

    //  if ($("#propinas").prop("checked")) {
    idEmolumento = 1;
    // }

    valueInputIdEmolumento = '"' + idEmolumento + '"';
    valueInputIdEstudante = '"' + idEst + '"';
    valueInputAno = '"' + ano + '"';
    //valueCantidadPagamentos = '"' + cantPagamentos + '"';

    //campos ocultos
    hiddenIdEmolumento = "<input type=" + tipoHidden + " value=" + valueInputIdEmolumento + " </>";
    hiddenIdEstudante = "<input type=" + tipoHidden + " value=" + valueInputIdEstudante + " </>";
    hiddenAno = "<input type=" + tipoHidden + " value=" + valueInputAno + " </>";
    hiddenCantidadPagamentos = "<input type=" + tipoHidden + " value=" + valueInputAno + " </>";
    nameHiddenJsonData = '"' + "valores" + '"';
    hiddenJsonData = $("#nameHiddenJsonData");
    // hidden_CSRF_TOKEN = $("#_token");





    var filas = [];
    $('#table-pagamentos tbody tr').each(function () {
      //  var mes = $(this).find('td ').eq(1).text();
      var mes = $(this).find('td ').eq(1).find('span').text();
      var valortaxa = $(this).find('td ').eq(3).find('input').val();
      // alert("valorTaxa");

      var valor = $(this).find('td ').eq(2).text();//+valortaxa;
      // var descricao = $(this).find('td ').eq(3).text();//+" "+valorTaxa;
      // var taxa=2500;
      // var taxaFinal=parseInt(valorTaxa)*taxa;
      var fila = {
        idEmolumento,
        idEst,
        mes,
        valor,
        ano,
        valortaxa
      };
      filas.push(fila);
    });
    // alert('recorrio todas las filas');
    valorHiddenDatos = JSON.stringify(filas);
    hiddenJsonData.val(valorHiddenDatos);

    $("#divMainPagamentos").css("visibility", "hidden");
    $("#tabelaPagamentos").css("visibility", "hidden");
    //valorToken=$('meta[name="csrf-token"]').attr('content');
    // alert(token);
    //hidden_CSRF_TOKEN.val(token);

    // $('#formularioPagosRealizados').append(hiddenIdEmolumento + hiddenIdEstudante + hiddenAno + hiddenCantidadPagamentos+ hiddenJsonData+ hidden_CSRF_TOKEN);
    //$('#formularioPagosRealizados').append('_token', "{{csrf_token()}}");
    //$('#formularioPagosRealizados').submit();

    //  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    /*
    $.ajax({
        type: "post",
        url: "/storePagamentos",
        data: {
          valores: JSON.stringify(filas)
  
        },
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
  
        success: function (data) {
  
          // window.location="/gerarComprovativo";
  
  
          /** ajax que no funciona */
    /*    $.ajax({
         type: "post",
        
         url: "/gerarComprovativo",
         data: {
           valores: JSON.stringify(filas)
   
         },
         headers: {
           'X-CSRF-TOKEN': CSRF_TOKEN
         }
   
        /* success: function (data) {
           
             window.location="/home";
   
         }*/
    //});

    /**Fin ajax que no funciona */

    /**ajax de teste */
    /*      $.ajax({
            type: 'post',
            url: '/gerarComprovativo',
            global: false,
            data: {
              'data': JSON.stringify(filas)
            }
            //,dataType: "text",
            //,async: false
          }).done(function (data, textStatus, jqXHR) {
            console.log(ruta);
            var nombreLogico = "XXX";
            var parametros = "dependent=yes,locationbar=no,scrollbars=yes,menubar=yes,resizable,screenX=50,screenY=50,width=850,height=1050";
            var htmlText = "<embed width=100% height=100% type='application/pdf' src='data:application/pdf," + escape(data) + "'></embed>";
            var detailWindow = window.open("", nombreLogico, parametros);
            detailWindow.document.write(htmlText);
            detailWindow.document.close();
          }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("error\njqXHR=" + jqXHR + "\nstatus=" + textStatus + "\nerror=" + errorThrown);
          }).always(function (dataORjqXHR, textStatus, jqXHR_ORerrorThrown) {
            //alert( "complete" );
          });
  
          /**fin ajax de teste */


    //      }
    //   });
    //fin do ajax

  });
});



$(document).ready(function () {
  $('.eliminarPago').click(function () {
    $('#table-pagamentos tbody tr').each(function () {
      $(this).remove();
    });

  });
});



$(document).ready(function () {
  $('#estudante').select2({

  });
  $('#paisOrigem').select2({

  });
  $('#estudantePagoEmolumento').select2({
    width: 'auto',
    width: 'resolve'
  });

  $('#emolumento').select2({
    width: 'resolve'
  });

  $('#formasDePago').select2({
    width: 'resolve',
    tags: true
  });
});

/*$(document).ready(function () {

  $("#formasDePago").change(function () {
    var count = $("#formasDePago option:selected").length;
    if (count > 1) {
      alert("mostrar obs");
    }
  });
  //var count = $("#formasDePago option:selected").length;


});*/


$("#emolumento").select2({
  dropdownAutoWidth: true,
  width: 'auto',
  width: 'resolve',
  placeholder: "Seleccione o mês a pagar",
});



//$("#divMainPagamentos").css("visibility", "hidden");


$(document).ready(function () {

  $("#emolumento").change(function () {
   
    valor = $("#emolumento option:selected").val();
  // $valoresSel= $('#emolumento > option').prop("selected",true);
//alert(idEmolumento);

  /*  if (mes == "outubro") {
      var oneMinute = 60 * 1000
      var oneHour = oneMinute * 60
      var oneDay = oneHour * 24
      var today = new Date()
      var nextXmas = new Date()
      nextXmas.setMonth(9)
      nextXmas.setDate(10)
      /*  if (today.getMonth() == 9 && today.getDate() > 10) {
          nextXmas.setFullYear(nextXmas.getFullYear() + 1)
        }
      var diff = today.getTime() - nextXmas.getTime()
      diff = Math.floor(diff / oneDay)


      alert("a diferencia é:" + diff);

      if (diff > 0) {
        alert("entro aqui");
        $('.select2-selection__choice').addClass('my-custom-css');
      }
    }*/

   // $("#emolumento option:selected").addClass("pagamentoConMulta");


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

$(document).ready(function () {
  jQuery('#mostrarTaxa').on('click', function (e) {
    alert("ok");
    $('#tabelaPagamentos tbody tr').each(function () {
      //  var mes = $(this).find('td ').eq(1).text();
      var valor = $(this).find('td ').eq(3).find('#taxa').val();

      alert(valor);
    });

  });
});