//Evento para cambiar as dispesas dos departamentos

$(function() {

 $('.btn-update-item').on('click',function(e){
    e.preventDefault();
    var id=$(this).data('id');
    var href=$(this).data('href');
    var cantidad=$('#dispesa_'+id).val();

    var href2=href+"/"+id+"/"+cantidad;
    //alert(href2);
 

    window.location.href=href2;

});


});

// Evento Hover para elementos de meses a pagar
$(function() {
 $('.proximoPagar').hover(

 	function(){ 
     $(this).addClass('hover').css("cursor","progress");
 	},


 	function(){
     $(this).removeClass('hover').css("cursor","auto");
 });

 	
 });

//evento para fazer pagamento directo de un mes

$(function() {

 $('.btn-fazer-pagamento').on('click',function(e){

    e.preventDefault();
    var nome=$(this).data('nome');
    var mes=$(this).data('mes');
    var id=$(this).data('id');

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

$(function() {

  $('.btn-fichaEstudante').on('click',function(e){
 
     e.preventDefault();
     var nome=$(this).data('nome');
     var apelido=$(this).data('apelido');
     var curso=$(this).data('curso');
     var nomeApelidos=nome+apelido;
 
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
$(function() {

  $("#turmaDinamico").change(function(event){
   // alert($(this).val());
       $.get("estudantes/"+$(this).val()+"", function(response,state){
         $("#estudanteDinamico").empty(); 
          for(i=0;i<response.length; i++){
            $("#estudanteDinamico").append("<option value='"+response[i].id+"'>"+response[i].nome+"</option>");
          }
       });
  });

});


//select dinamico de meses pagos
$(function() {

  $("#selectFazerPagamento").change(function(event){
     ano= $('#valorPagamento').val();
     url="mesesValidos/"+$(this).val()+"/"+ano+"";
    // alert(url);
    // alert(ano);
       $.get(url, function(response,state){
         $("#mesesFazerPagamento").empty(); 
          for(i=0;i<response.length; i++){
            $("#mesesFazerPagamento").append("<option disabled value='"+response[i].mes+"'>"+response[i].mes+"(pago)"+"</option>");
          }
          for(i=response.length+1;i<=12; i++){
            $("#mesesFazerPagamento").append("<option value='"+i+"'>"+i+"</option>");
          }
       }); 
  });

});

//pagamentos por turma seleccionada
$(document).ready(function() {
  
                                                                                                     
        $("#selectTurma").change(function(event){
          //alert('aqui');
          consulta = $(this).val();

          url="busquedaTurma/"+consulta+"";
         // requestInfo="busqueda/";

         // url="http://192.168.10.150/propinasGeral/";
        // alert(url);
          if (consulta=="") {
            $("#tbodyResultado").empty(); 
          }


        $.getJSON(url, function(response,state){
         $("#tbodyResultado").empty();
           nomeActual="";
           $.each(response, function(k, v) {
            meses=buscar(v.nome,response);
            cadena="";
            cadena2="";
            for (i = 0; i <meses.length; i++) 
            {
              //cadena+=" "+meses[i]+" ";
             classe='"'+"col-md-1 test"+'"';
             classe2='"'+"col-md-1 sinPagar"+'"';
             cadena+="<div class="+classe+">"+meses[i]+"</div>"; 
            }

            for (j =meses.length+1; j <=12; j++) {
                       cadena2+="<div class="+classe2+">"+j+"</div>"; 
                     }    



            if (nomeActual!=v.nome) {
              nomeActual=v.nome;
              classe2='"'+"col-md-12"+'"';
              classe3='"'+"col-md-6"+'"';
              classeImg='"'+"fa fa-user fa-5x"+'"';
              classeRow='"'+"row"+'"';
              ancho='"'+"40"+'"';
              imagen=`<img src={{url('/storage/'v->pathImage) }}></img>`;
               $("#tbodyResultado").append("<tr><td><div class="+classeRow+"><div class="+classe3+"><i class="+classeImg+"></i>"+"</div>"+"<div class="+classe3+">"+imagen+v.nome+"</div>"+"</div>"+"</td> <td><div class="+classeRow+"><div class="+classe2+">"+cadena+cadena2+"</div></div></td></tr>");
            
             //  $("#tbodyResultado").append("<td><div class="+classeRow+"><div class="+classe2+">"+cadena+"</div></div></td></tr>");
            }
           
             
            


         
          });



       });  
                                                               
    }); 
  });



//pagamentos por estudiante digitado
$(document).ready(function() {
  
                                                                                                     
        $("#busqueda").keyup(function(event){
          //alert('aqui');
          consulta = $(this).val();

          url="busqueda/"+consulta+"";
         // requestInfo="busqueda/";

         // url="http://192.168.10.150/propinasGeral/";
        // alert(url);
          if (consulta=="") {
            $("#tbodyResultado").empty(); 
          }


        $.getJSON(url, function(response,state){
         $("#tbodyResultado").empty();
           nomeActual="";
           $.each(response, function(k, v) {
            meses=buscar(v.nome,response);
            cadena="";
            cadena2="";
            for (i = 0; i <meses.length; i++) 
            {
              //cadena+=" "+meses[i]+" ";
             classe='"'+"col-md-1 test"+'"';
             classe2='"'+"col-md-1 sinPagar"+'"';
             cadena+="<div class="+classe+">"+meses[i]+"</div>"; 
            }

            for (j =meses.length+1; j <=12; j++) {
                       cadena2+="<div class="+classe2+">"+j+"</div>"; 
                     }    



            if (nomeActual!=v.nome) {
              nomeActual=v.nome;
              classe2='"'+"col-md-12"+'"';
              classe3='"'+"col-md-6"+'"';
              classeImg='"'+"fa fa-user fa-5x"+'"';
              classeRow='"'+"row"+'"';
              ancho='"'+"40"+'"';
              ruta="propinas/fichaPagamento/"+v.id;
              rutaEditar="estudantes/editar/"+v.id;
              pathImage="'"+"/storage/"+"'"+v.pathImage;
              imagem="<img src="+"{{url("+pathImage+") }}"+"></img>";
            
             
              link="<a href="+'"'+ruta+'"'+">"+v.nome+"</a>";
              linkEditar="<br><a href="+'"'+rutaEditar+'"'+">"+"editar"+"</a>";

              //link="<a href="+ruta+">"+v.nome+"</a>";
               $("#tbodyResultado").append("<tr><td><div class="+classeRow+"><div class="+classe3+"><i class="+classeImg+"></i>"+imagem+"</div>"+"<div class="+classe3+">"+link+linkEditar+"</div>"+"</div>"+"</td> <td><div class="+classeRow+"><div class="+classe2+">"+cadena+cadena2+"</div></div></td></tr>");
            
             //  $("#tbodyResultado").append("<td><div class="+classeRow+"><div class="+classe2+">"+cadena+"</div></div></td></tr>");
            }
           
             
            


         
          });



       });  
                                                               
    }); 
  });


//

 function buscar(nome,resp){
  resultado=[];

   $.each(resp, function(k, v) {
     if (v.nome==nome) {
      resultado.push(v.valor);
     }

   });

   return resultado;

 }

 function pagamentos(id,ano){
  var resultado=[];

  $(document).ready(function(){

    url="pagamentosEstudantes/"+id+"/"+ano;

   
     $.getJSON(url,function(response,state){

        $.each(response,function(k,v){

          resultado.push(v.valor);

        });

       });
  });
 

  return resultado;
 }  



 






