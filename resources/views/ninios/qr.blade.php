<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código Qr de {{ $ninio->nombres }}</title>
    <style>
       
        table {
            border-collapse: collapse;
            }
            
            table, th, td {
            border: 1px solid black;
            }
    </style>
</head>
<body>
    <div>
        <h1 style="text-align: center;color: black;">CACTU</h1>
        <div class="visible-print text-center">
            {!! QrCode::
                encoding('UTF-8')
                ->margin(1)
                ->errorCorrection('H')
                ->size(395)->generate((string)$ninio->id); !!}
        </div>
        <p style="text-align: center;">{{ $ninio->nombres }}</p>
        <p style="text-align: center;">
            @if ($ninio->genero=='Male')
                Masculino
            @else
                Femenino
            @endif
        </p>
        <p style="text-align: center;">
            {{ $ninio->comunidad->nombre??'' }}
        </p>
    </div>
</body>
</html>