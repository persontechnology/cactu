<div class="wrapper">
    <div class="container">
                        
<input type="hidden" class="hidden" name="cliIP" id="cliIP" value="33">




        <input type="hidden" class="hidden" name="empUrl" id="empUrl" value="online.oscus.coop">
        <link href="css/style_login.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="jsencrypt/jsencrypt.js"></script>
<!--<script type="text/javascript" src="CryptoJS/rollups/tripledes.js"></script>
<script type="text/javascript" src="CryptoJS/rollups/md5.js"></script>-->
<input type="hidden" name="redirect" id="redirect" value="">
<div class="container  ">
    <div class="container-box-login">
        <div class="container-logo-crea-login">
            <img class="img-responsive center-block" src="img/logo-blanco.png" width="280" height="" alt="">
        </div>
        <div class="card card-container" id="login-container">
            <p style="color:white; text-align : justify;">
            Cooperativa OSCUS no solicita sus datos personales, claves o contraseñas mediante el envío de un mail ni a través de ningún otro medio.            </p>    
            
            
<form class="form-signin" action="javascript:void(0);" id="form-preguntas">
    <p id="profile-name" class="profile-name-card"> Por favor completa este formulario para crear tus credenciales de acceso:</p>
    <div class="row" style="margin-top: 10px;">
        <div class=" form-group col-md-12">

            <select id="selectIdentiTipo" class="form-control required" name="selectIdentiTipo" style="float:left; margin-bottom:20px;" label="">
                <option value="cedula">Cédula / RUC</option>
                <option value="pasaporte">Pasaporte</option>
            </select>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                <input type="text" class="form-control required" name="sIdentificacion" id="sIdentificacion" placeholder="Número de identificación" autocomplete="off">
            </div>
        </div>
    </div>
    <!--<div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i></span>
                <input type="text" class="form-control required date" name="fechaNacimiento" id="fechaNacimiento"  placeholder="Fecha de nacimiento Ej. 1990-01-15" autocomplete="off"/>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag fa-lg" aria-hidden="true"></i></span>
                <input type="text" class="form-control required number" name="numeroCuenta" minlength="5" maxlength="12" id="numeroCuenta"  placeholder="Número de cuenta de ahorros" autocomplete="off"/>
            </div>
        </div>
    </div>-->

    <br>              
  <button class="btn btn-lg btn-primary btn-block btn-signin" id="btn-preguntas" onclick="verificarInformacionCliente(this);">CONTINUAR <i class="fa fa-arrow-right"></i></button>
</form><!-- /form -->
        </div><!-- /card-container -->
    </div>
    <div>
        
        <input type="hidden" name="empCodigo" id="empCodigo" value="oscus">
        <input type="hidden" name="empUrlTransaccional" id="empUrlTransaccional" value="oscus-online">
        <input type="hidden" name="accion" id="accion" value="registrarse">
        <input type="hidden" name="idCliente" id="idCliente" value="">
        <input type="hidden" name="codigoSocio" id="codigoSocio" value="">
        <input type="hidden" name="identificacionClave" id="identificacionClave" value="">
        <div id="auxInputs"></div>
    </div>
</div>


<div id="modalContrato" class="modal fade" role="dialog">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title text-center">CONTRATO DE SERVICIOS DE BANCA ELECTRÓNICA</h4>
          </div>
          <div class="modal-body">
            GCM.SER.RGO.05<br>
REV. 03<br>
<br>
CONVENIO PARA LA UTILIZACIÓN DEL SERVICIO OSCUS ON LINE <br>
<br>
CLÁUSULA PRIMERA: La Cooperativa de Ahorro y Crédito OSCUS Ltda. que para efectos de este contrato será llamada LA COOPERATIVA, con la finalidad de proveer a su SOCIO/CLIENTE titular o representante de la cuenta, de un medio electrónico para la utilización de los productos y servicios, ha implementado el servicio OSCUS ON LINE.<br>
Por su parte El SOCIO/CLIENTE titular o representante de la cuenta acepta las condiciones establecidas en este convenio, para el uso del servicio OSCUS ON LINE a partir de la presente fecha de aceptación.<br>
<br>
CLÁUSULA SEGUNDA: Con lo expuesto El SOCIO/CLIENTE titular o representante declara que es de su conocimiento que el servicio OSCUS ON LINE opera exclusivamente a través del Internet y telefonía móvil.<br>
<br>
CLÁUSULA TERCERA: LA COOPERATIVA a través de OSCUS ON LINE brindará al SOCIO/CLIENTE titular o representante los siguientes servicios:<br>
a)	 Consulta de préstamos.<br>
b)	 Consultas de saldos y movimientos de su cuenta de ahorro.<br>
c)	 Consulta de depósitos a plazo.<br>
d)	 Transferencia de fondos a instituciones del sistema financiero ecuatoriano participantes del Sistema de Pagos Interbancarios; y, entre cuentas de la Cooperativa.<br>
e)	 Recargas para telefonía celular <br>
f)	 Pagos de diversos servicios<br>
Las partes acuerdan que LA COOPERATIVA puede adicionar, modificar, retirar parcial o totalmente cualquiera de los componentes del servicio OSCUS ON LINE, que se encuentran a disposición del SOCIO/CLIENTE titular o representante. Para el efecto y con el propósito de mantener informado al SOCIO/CLIENTE titular o representante, sobre los servicios disponibles, LA COOPERATIVA pondrá en conocimiento las transacciones que pueda realizar a través de la página web: https://www.oscus.coop y de la APP.<br>
<br>
CLÁUSULA CUARTA: LA COOPERATIVA y el SOCIO/CLIENTE titular o representante acuerdan las siguientes condiciones para la operatividad de este servicio:<br>
1) El SOCIO/CLIENTE tendrá acceso al servicio OSCUS ON LINE, como titular o representante de la cuenta a través del usuario y clave de acceso ingresados por él.<br>
EL SOCIO/CLIENTE pondrá en conocimiento y actualizará en LA COOPERATIVA la dirección de correo electrónico, así como su número de teléfono celular, a los que le llegarán las distintas notificaciones, tanto de sus transacciones, como de los números token para el procesamiento de las transacciones en el servicio OSCUS ON LINE. <br>
2) La información proporcionada por el SOCIO/CLIENTE titular o representante es de su exclusiva responsabilidad. <br>
3) LA COOPERATIVA proporcionará al SOCIO/CLIENTE titular o representantede un acceso seguro al sitio web y app con el fin de que pueda acceder a los servicios descritos en este convenio. <br>
4) El SOCIO/CLIENTE titular o representante a través de la clave de acceso es el responsable ante LA COOPERATIVA y terceros de las transacciones realizadas en virtud del uso que se efectúe sobre el sistema OSCUS ON LINE. Con la clave el SOCIO/CLIENTE titular o representante podrá acceder al sistema OSCUS ON LINE y efectuar las operaciones detalladas en la cláusula tercera. El SOCIO/CLIENTE titular o representante, declara y reconoce que la clave de acceso será bloqueada a partir del tercer intento de ingreso fallido.<br>
5) El SOCIO/CLIENTE titular o representante, podrá recuperar o generar una nueva clave de acceso a través del servicio OSCUS ON LINE.<br>
6) Las claves del servicio OSCUS ON LINE son personales e intransferibles y serán indispensables para el acceso y utilización de este servicio; en virtud de lo cual el SOCIO/CLIENTE titular o representante de manera expresa se compromete a mantener éstas y las posteriores claves que se establezcan en estricta reserva.<br>
7) EL SOCIO/CLIENTE titular o representante autoriza y acepta que las transacciones que se efectúen por este canal puedan realizarse desde cualquier IP a nivel nacional o internacional.<br>
<br>
CLÁUSULA QUINTA: Se deja expresa constancia que el sistema OSCUS ON LINE es de propiedad única y exclusiva de LA COOPERATIVA y que el servicio prestado al SOCIO/CLIENTE titular o representante se efectúa con la intención de brindarle una mejor atención. Su funcionamiento es permanente excepto por casos fortuitos o de fuerza mayor. Cuando se prevea sustituir, mejorar o modificar el servicio y afecte a la operatividad, LA COOPERATIVA notificará al SOCIO/CLIENTE titular o representante con anticipación a la fecha de aplicación, mediante los diferentes canales de comunicación de LA COOPERATIVA.<br>
<br>
CLÁUSULA SEXTA: Si bien el servicio de OSCUS ON LINE tiene la característica 24/7 (veinte y cuatro horas/siete días de la semana), las transferencias que se realicen en días no Contrato de uso de canales electrónicos Cooperativa de ahorro y crédito Oscus laborables se registrarán con la fecha del siguiente día hábil.<br>
<br>
CLÁUSULA SÉPTIMA: El plazo del presente convenio es de UN AÑO, contado a partir de la fecha de aceptación virtual. Se renovará automáticamente para cada período, si ninguna de las partes notificare por escrito a la otra su deseo de darlo por terminado con al menos 30 días de anticipación.<br>
<br>
CLÁUSULA OCTAVA: Por el uso del servicio OSCUS ON LINE, LA COOPERATIVA cobrará el valor establecido en su Tarifario de Costos y Servicios, dispuesto por la autoridad competente.<br>
<br>
CLÁUSULA NOVENA: El SOCIO/CLIENTE titular o representante es responsable de las transacciones que realice mediante la utilización del servicio OSCUS ON LINE con sus claves. LA COOPERATIVA no asume responsabilidad alguna cuando el SOCIO/CLIENTE titular o representante no pueda efectuar sus transacciones por desperfectos ocasionales o recurrentes de sus equipos, o por suspensión parcial o total del servicio.<br>
<br>
CLÁUSULA DÉCIMA: El SOCIO/CLIENTE titular o representante administrará sus claves con suma diligencia y será responsable por todas las especies de culpa; con el fin de aplicar elementos de seguridad la clave de acceso deberá ser cambiada por lo menos una vez al año.<br>
La COOPERATIVA realizará las transacciones ordenadas por el SOCIO/CLIENTE titular o representante, por lo tanto, renuncia expresamente a cualquier reclamo contra LA COOPERATIVA por los siguientes motivos:<br>
a) Transacciones efectuadas erróneamente.<br>
b) Insuficiencia de fondos en sus cuentas en los casos que aplique.<br>
c) Por situaciones de fuerza mayor para LA COOPERATIVA, que dificulten el uso del servicio.<br>
El SOCIO/CLIENTE se compromete a notificar inmediatamente a LA COOPERATIVA a través del call center 1800-OSCUS1 o en nuestras oficinas de presentarse movimientos no autorizados por el titular de la cuenta, para que LA COOPERATIVA proceda con el bloqueo.<br>
<br>
CLÁUSULA DÉCIMA PRIMERA: El SOCIO/CLIENTE titular o representante declara que los fondos de las transacciones que realice a través del servicio OSCUS ON LINE prestado por LA COOPERATIVA, son lícitos y no provienen ni serán destinados a la realización o financiamiento de ninguna actividad ilícita. Conocedor de las disposiciones para reprimir el Lavado de Activos y Financiamiento de Delitos, autoriza expresamente a LA COOPERATIVA a realizar el análisis y verificaciones que considere necesarios, así como notificar a las autoridades competentes en caso de llegar a determinar la existencia de transacciones inusuales e injustificadas. En virtud de lo autorizado, renuncia a instaurar por este motivo cualquier tipo de acción civil, penal o administrativa en contra de LA COOPERATIVA.<br>
<br>
CLÁUSULA DÉCIMA SEGUNDA: Suspensión del Convenio, cuando se presenten circunstancias de fuerza mayor o caso fortuito debidamente demostrados de conformidad a lo que establece el Código Civil, que impidan la continuación del convenio, las partes suspenderán su ejecución; igualmente se adoptarán las medidas de conservación que sean pertinentes o la terminación del convenio, sin más obligaciones que las que se hubieran generado a la fecha.<br>
	En el caso de adoptarse la suspensión de la ejecución, vencido el término de suspensión las partes volverán a suscribir un nuevo convenio. <br>
<br>
CLÁUSULA DÉCIMA TERCERA: Exclusión de responsabilidad, LA COOPERATIVA no es ni será responsable en ningún tiempo, del mal uso de las claves que en virtud de este convenio se otorgue a los SOCIOS/CLIENTES quedando a exclusiva responsabilidad de los mismos la utilización de dichas claves. <br>
	EL SOCIO/CLIENTE, como propietario del equipo por medio del cual accede al servicio, es responsable de cualquier pérdida, error o daño de información, transacciones y otras pérdidas causadas por fallos en su computadora, dispositivo móvil o su respectivo proveedor de Internet (ISP), a su vez, afirma que LA COOPERATIVA no es responsable por daños ocasionados a su equipo, su información o sus programas, causados por los denominados virus, troyanos, malware, hackers u otros componentes dañinos o amenazas informáticas que puedan introducirse en su equipo durante el uso del servicio.<br>
<br>
CLÁUSULA DÉCIMA CUARTA: Correspondencia y Notificaciones, Para los distintos efectos previstos en este convenio, las comunicaciones, solicitudes, avisos, notificaciones o citaciones, que deban realizar los SOCIOS/CLIENTES se lo hará en forma escrita en idioma castellano a través de correspondencia tradicional, por fax, correo electrónico, sistema de audio respuesta IVR, señal telefónica, celular e internet, mensajes de textos u otros similares o en las diferentes Oficinas, bastando en cada caso, que el remitente obtenga la correspondiente Contrato de uso de canales electrónicos Cooperativa de ahorro y crédito Oscus constancia de que su comunicación ha sido recibida. A efectos, las Partes señalan como su domicilio los siguientes:<br>
EL SOCIO/CLIENTE: La dirección, teléfono y correo electrónico que mantiene registrado en la base de datos de LA COOPERATIVA.<br>
COOPERATIVA DE AHORRO Y CRÉDITO OSCUS LTDA:<br>
Dirección: Lalama 06-39 entre Sucre y Bolivar <br>
	Teléfono: 	032821131/2422146 Ext 188<br>
	E-mail: 	quejasyreclamos@oscus.coop<br>
<br>
CLÁUSULA DÉCIMA QUINTA: Terminación del convenio, el presente convenio se podrá dar por terminado por las siguientes causales.<br>
a) 	Por mutuo acuerdo de las partes<br>
b) 	De manera unilateral, por convenir a los intereses de LA COOPERATIVA, en el caso de que el SOCIOS/CLIENTE se encuentre inmerso en las listas del control e inhabilitados para lo cual LA COOPERATIVA se reserva el derecho de realizar la verificación en cualquier tiempo en el sistema, en el caso de verificarse este hecho se procederá a notificar por escrito de la terminación del convenio; excepto cuando se trate de homónimos debidamente justificados.<br>
c) 	Por incumplimiento de las obligaciones contractuales<br>
<br>
CLÁUSULA DÉCIMA SEXTA: Las partes renuncian fuero y declaran que todas las controversias que se deriven de este convenio y que no pudieren ser solucionadas directa y amigablemente por las partes, sea en su interpretación o ejecución, éstas la someten a la resolución de un Tribunal de Arbitraje y Mediación de la ciudad de Ambato, de acuerdo con las siguientes reglas: <br>
a) Los árbitros serán seleccionados conforme a lo establecido en la Ley de Arbitraje y Mediación;<br>
b) Las partes renuncian jurisdicción ordinaria, se obligan a acatar el laudo que expida el Tribunal Arbitral y se comprometen a no interponer ningún tipo de recurso en contra del laudo arbitral; <br>
c) Para la ejecución de las medidas cautelares, el Tribunal Arbitral está facultado para solicitar de los funcionarios públicos, judiciales, policiales y administrativos, su cumplimiento, sin que sea necesario acudir a Juez Ordinario alguno; <br>
d) El Tribunal estará integrado por un árbitro; <br>
e) El procedimiento arbitral será confidencial y en derecho; y,<br>
f) El lugar de arbitraje será la ciudad de Ambato, cantón del mismo nombre, provincia de Tungurahua.            <div class="row">
                <div class="col-md-12 text-center" style="margin-top:10px">
                    <a class="text-center" style="cursor: pointer;" onclick="$('#modalContrato').modal('hide');">REGRESAR</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    var PublicKey = '';
    var PrivateKey = '';

</script>
<script type="text/javascript" src="js/rsa/validateKey.js"></script>
        <div class="aro-pswd_info hidden-xs hidden-sm">
          <div id="pswd_info">
              <!--<h4>Condiciones de la contraseña</h4>-->
              <ul>
                  <li id="letter" class="invalid">Por lo menos <strong>una letra</strong></li>
                  <li id="capital" class="invalid">Por lo menos <strong>una mayúscula</strong></li>
                  <li id="number" class="invalid">Por lo menos <strong>un número</strong></li>
                  <li id="length" class="invalid">Mínimo <strong>8 caracteres</strong></li>
                  <!--<li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>-->
              </ul>
          </div>
      </div>

    </div>
</div>