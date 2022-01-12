<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $ninio->nombres }}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    @include('ninios.datos',['ninio'=>$ninio])
</body>
</html>