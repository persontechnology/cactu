<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $asis->fecha }}</title>
    <style>
        table {
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }
              
        table, th, td {
            border: 1px solid black;
        }
        .mitexarea{
            width: 100%;
        }

        .noBorder {
            border:none !important;
        }
    </style>
    
</head>
<body>
        
        <div style="overflow-x:auto;">
        @include('registros.asistencias.tablaListadoExportar',['asis'=>$asis])
        </div>
</body>
</html>