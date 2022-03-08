<!DOCTYPE html>
<html lang="en">

<head>

  
    <title>Caixa</title>
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<style type="text/css">
        .pago
        {
         background: blue;
        }
        .naoPago
        {
            background: red;
        }


        .pt-3-half {
           padding-top:1.4rem;


       }


       .test
{
    border-radius: 1em;
    background: green;
    border: 2px solid black;
}
.mes{
    
    font-size: 2 !important;
}


.conMulta
{
    border-radius: 1em;
    background: green;
    border: 2px solid red;
}

.sinPagar
{
    border-radius: 1em;
    background: white;
    border: 2px solid black;
}

.proximoPagar
{
    border-radius: 1em;
    background: white;
    border: 2px solid black;
}

.proximoPagar:hover
{
    color:white;
}

.proximoPagar span:hover
{
    color:white;
}

   </style>

<script>

    //pagamentos por estudiante digitado
$(document).ready(function() {
  
                                                                                                     
  $("#busqueda").keyup(function(event){
    //alert('ok');
    consulta = $(this).val();

    url="busquedaCaixa/"+consulta+"";
   // requestInfo="busqueda/";

   // url="http://192.168.10.150/propinasGeral/";
  // alert(url);
    if (consulta=="") {
      $("#resultado").empty(); 
    }


  $.getJSON(url, function(response,state){
   $("#resultado").empty();
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
       // ancho='"'+"40"+'"';
        ruta="fichaPagamento/"+v.id;
       
        link="<a href="+'"'+ruta+'"'+">"+v.nome+"</a>";
        //link="<a href="+ruta+">"+v.nome+"</a>";
       //  $("#resultado").append("<tr><td><div class="+classeRow+"><div class="+classe3+"><i class="+classeImg+"></i>"+"</div>"+"<div class="+classe3+">"+link+"</div>"+"</div>"+"</td> <td><div class="+classeRow+"><div class="+classe2+">"+cadena+cadena2+"</div></div></td></tr>");
       $("#resultado").append("<p>"+link+"</p>");

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
resultado.push(v.mes);
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

</script>
<body>

@yield('content')

</body>

</html>





