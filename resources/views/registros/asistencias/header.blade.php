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
    <table  style="border-collapse: collapse; border: none; width: 100%">
        <td class="noBorder">
                <img src="{!! public_path('img/cactu-logo.jpeg') !!}" alt="" width="120px;" style="text-align: left;">
        </td>
        <td class="noBorder">
                <h3 style="text-align: center;">REGISTRO DE ASISTENCIA A ACTIVIDADES</h3>
        </td>
        <td class="noBorder">
            
            <img src="{!! public_path('img/childfund.jpg') !!}" alt="" width="120px;" style="text-align: right;">
        </td>
    </table>
</body>
</html>