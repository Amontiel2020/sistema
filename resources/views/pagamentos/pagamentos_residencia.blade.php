<!doctype html>

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Example</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <style>
        body{
            background-color: #c9dcef;
        }
        .grid {
            display: grid;
            /* grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));*/
            grid-template-columns: minmax(200px, 1fr) minmax(200px, 1fr);
            grid-template-rows: minmax(200px, 1fr) minmax(200px, 1fr) minmax(200px, 1fr);
            grid-gap: 20px;
            align-items: start;
        }

        .grid>article {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
        }

        .grid>article img {
            max-width: 100%;
        }

        .text {
            padding: 0 20px 20px;
        }

        .text>button {
            background: gray;
            border: 0;
            color: white;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>

<body>
<br>
<div class="page-header"></div>
    <div class="container-fluid">
        <div id="pagamentosResidencias"></div>

    </div>

    <script type="text/javascript" src="js/app.js"></script>
</body>

</html>