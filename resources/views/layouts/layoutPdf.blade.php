<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  

    <title>Escola Superior Politecnica de Benguela</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div align="center" class="text-center">
                    <img src="{{ public_path('imagenes-perfil/logo.png') }}">
                    <p>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA<p>
                        <p>Decreto Presidencial nº 168/12 de 24 de Julho</p>
                        Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com<br>
                        Bairro da Graça - Benguela<br>
                        Angola</p>
                    <h4> LISTA DE PRECENÇAS</h4>


                </div>
                <p>Docente:_____________________________________ Curso:____________________________________</p>
                <p>Unidade Curricular_______________________________________________________________________</p>
                <p>Data_____/_____/_____ Entrada: Das_____ às_____</p>

                @yield('content')
                <p><b>Asinatura do professor</b>__________________________________________________________</p>
            </div>
        </div>
    </div>
</body>

</html>