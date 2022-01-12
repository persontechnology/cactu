<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $asis->fecha }}</title>
    <style>
         div.page{
            page-break-after: always;
            page-break-inside: avoid;
        }
        table {
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }
              
        table, th, td {
            border: 1px solid black;
            padding: 3px;
        }
        .mitexarea{
            width: 100%;
        }

        .noBorder {
            border:none !important;
        }
        .filas{
            font-size: 13px;
            
        }
    </style>
    <style type="text/css">
        @media print {
                .element-that-contains-table {
                    overflow: visible !important;
                }
            }

        thead{display: table-header-group;}
        tfoot {display: table-row-group;}
        tr {page-break-inside: avoid;}

    </style>
</head>
<body>
        
        <div>
        @include('registros.asistencias.tablaExportacionSoloPdf',['asis'=>$asis])
        </div>
</body>
</html>