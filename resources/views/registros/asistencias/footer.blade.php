<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</head>
<body>
    <table>
        <tfoot>
            <tr>
                <td colspan="9">
                    <i>Guia de desglose:</i><br>

                    <small>
                        <strong>VOLUNTARIO COMUNITARIO:</strong>Madres guía, madres talleristas, jóvenes líderes, miembros de junta o comité <br>
                        <strong>PERSONAL DE SOCIO LOCAL:</strong>Técnicas de etapa de vida, movilizadores comunitarios, movilizador de federación, facilitadores de sesión <br>
                        <strong>SOCIEDAD CIVIL:</strong>Representes de organizaciones sociales, líderes comunitarios, miembros de la comunidad general
                    </small>
                </td>
                
                <td colspan="10">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <strong>Responsable:</strong>
                                    {{ $asis->responsable->name }}
                                </td>
                                <td>
                                    <strong>Firma:</strong>
                                    {{ $asis->responsable->email }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    Cantidad y detalle de material entregado:
                                </th>
                            </tr>
                            <tr class="mt-0">
                                <td colspan="2">
                                    {{ $asis->detalle }} 
                                </td>
                            </tr>
                        </table>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>