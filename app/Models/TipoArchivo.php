<?php
/*
    * En este modelo que realizará la careación de los tipos de archivo para la carpeta del afiliado
    * Para la carpeta se tomara e cuenta que existe una clasicación de archivos.
    * La capacidad máxima del peso del ducumento debera ser de 8Mb
    * Este modelos se amplia en el contrato carpeta digital para los afiliados 
    * Responsable: Fabian López
    *
*/
namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;

class TipoArchivo extends Model
{
    protected $table="tipo_archivos";
}
