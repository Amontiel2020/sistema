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
                <div class="text-center">
                    <img src="{{ public_path('imagenes-perfil/logo.png') }}">
                    <p>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA<br>
                        Decreto Presidencial nº 168/12 de 24 de Julho<br>
                        Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com<br>
                        Bairro da Graça - Benguela<br>
                        Angola</p>
                    <h4> Comprovativo de pagamento</h3>


                </div>
  
                @yield('content')
                <p><b>Asinatura do estudante</b>__________________________________________</p>
                <p><b>Nome do funcionario</b>_____________________________________________</p>

            </div>
        </div>
    </div>
</body>

</html>