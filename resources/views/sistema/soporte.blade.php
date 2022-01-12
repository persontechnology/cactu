@extends('layouts.app',['title'=>'Soporte'])

@section('breadcrumbs', Breadcrumbs::render('soporte'))

@section('content')


<div class="card">
   
    <div class="card-body">
        <h1>¿Qué es el soporte informatico?</h1>
        <p class="text-justify">
            El soporte informatico es el servicio mediante el cual los especialistas en apoyo informático proporcionan asistencia técnica, soporte remoto y asesoramiento a individuos y organizaciones que dependen de la tecnología de la información.
        </p>
        <hr>
        <h1>¿Qué tipos de soportes informáticos existen?</h1>
        <p class="text-justify">
            Una de las clasificaciones más claras de este servicio es la que distingue las dos formas de prestación de la ayuda, por ello, nos podemos encontrar:
        </p>
        <h2><i class="far fa-hand-point-right"></i> Soporte técnico físico</h2>
        <p class="text-justify">
            Es aquel que atiende y ejecuta automáticamente los programas de diagnóstico para resolver problema in situ, es decir, en la sede de la empresa. De todas formas, su labor no es solo la de diagnosticar un problema y solucionarlo, sino que también pueden formar al equipo en el uso del software o el hardware o las redes de la empresa.
        </p>
        <h2><i class="far fa-hand-point-right"></i> Servicio informático remoto</h2>
        <p class="text-justify">
            Se realiza a través de la red o por teléfono y se suele dar por parte de proveedores que ofrecen un servicio y también la solución a posibles problemas que puedan surgir con él. El servicio técnico remoto cada vez está avanzando más, de forma que es una manera muy útil de detectar un problema, hacer un diagnóstico y buscar una solución. Por ejemplo, a partir de opciones como el escritorio remoto, el técnico puede acceder directamente al equipo del cliente para poder llevar a cabo su trabajo de una forma totalmente libre y ofrecer los mejores resultados.
        </p>
        <hr>
        <h1>¿Cómo trabaja un soporte informático?</h1>
        <p class="text-justify">
            Cuando existe un contrato entre el proveedor y el cliente, se debe especificar cuáles son las acciones que incluye el documento. Por eso, el contrato con un servicio de soporte informático es tan importante. Te recomendamos que leas las cláusulas detenidamente y que cambies, añadas o suprimas las que creas necesarias para evitar posibles problemas a largo plazo.
        </p>
        <p class="text-justify">
            En cuanto sepas si se te va a prestar servicio técnico de forma física o remota, debes saber las condiciones de prestación. Aunque el soporte remoto suele ser más rápido al evitar el desplazamiento, en ocasiones, si no está calificado como prioritario podría hacerte esperar y ralentizar tu trabajo.
        </p>
    </div>
    <div class="card-footer text-center">
        <h3>Contactos</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>
                        Ing. Fabian López
                    </th>
                    <td>
                        <i class="fab fa-whatsapp"></i> 0984372998 <br>
                        <i class="far fa-envelope"></i> fabi.lopez1992@gmail.com <br>
                        <i class="fab fa-facebook-square text-primary"></i> <a href="https://www.facebook.com/fabi.lopez.1466" target="_blanck">@Fabi Lopez</a>
                    </td>
                </tr>
                <tr>
                    <th>
                        Soysoftware
                    </th>
                    <td>
                        <i class="fab fa-whatsapp"></i> 0998808755 <br>
                        <i class="fas fa-phone-volume"></i> 032730015 <br>
                        <i class="far fa-envelope"></i> info@soysoftware.com <br>
                        <i class="fas fa-wifi"></i> <a href="https://soysoftware.com/" target="_blanck">www.soysoftware.com</a> <br>
                        <i class="fab fa-facebook-square text-primary"></i> <a href="https://persontechnology.com/" target="_blanck">@persontechnology</a>
                    </td>
                </tr>
            </table>
        </div>
        
    </div>
</div>

@push('linksCabeza')

@endpush

@prepend('linksPie')
    
@endprepend

@endsection
