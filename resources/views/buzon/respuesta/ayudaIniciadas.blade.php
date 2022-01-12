

    <div class="container1">
        <br>
        <br>
        @php
        $date = (\Carbon\Carbon::now());
        @endphp

    <div class="card p-4 mt-2 dosdr">
        <p>Fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</p>
        @if ($buzonCarta->buzon->ninio->fechaNacimiento)            
            @php
                $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age
            @endphp
        {{-- 6244 --}}
            @if ($edad>5)            
            <p class="text-lg-left font-weight-normal"  >
               
                Hola Donnielle Willear <span> (nombrar al patrocinador)</span> <br>
                Soy Abdon  <br>
                <span> Responder quienes son tus mejores amigos. </span> <br>
                Mis mejores amigos son mi hermano Yvan y Darwin porque juegan conmigo con mis carros <br>
                <span> Responder que quiero ser de grande, </span> <br>
                Mi sueño es ser un policía <br>
                Por el momento el no está en la escuela pasa en su casa po el virus. <br>
                <span> Responder te gusta hacer </span> <br>
                Lo que mas me gusta hacer es jugar voly, pasear en la bicicleta y las escondidas. <br>
                <span> Responder en que te gusta participar en la organización </span> <br>
                <span> Childfund es una programa muy bonito a mi me encanta participar encanta pintar hacer amigos modelar plastilina</span> <br>
                <span class="text-pink-600"> Responder como es su lugar donde vive. No dar direcciones. </span> <br>
                Vivo con mis padres y hermanos alejados de la ciudad, nuestro idioma es el español y quichua. <br>
                <span> Responder que le gusta de comer: </span> <br>
                Mi plato típico es el caldo de gallina papas con cuy y la colada morada <br>
                Gracias por patrocinar a mi hermano Jhon le agradezco mucho por su amistad <br>
                Hasta la próxima Att. Abdo Oyagato. <br>
            
            </p>
            @else
                <p class="text-lg-left font-weight-normal"  >
                    <span class="text-pink-600">Es menor de 6 Años se debe responder en tercera persona</span> <br>
                    Hola Donnielle Willear <span> (nombrar al patrocinador)</span> <br>
                    Soy Abdon Hermano mayor de jhon el tiene 4 año y aun no puede escribir, <br>
                    <span> Responder quienes son sus mejores amigos. </span> <br>
                    Sus mejores amigos son su hermano Yvan y Darwin porque juegan con el con sus carros <br>
                    <span> Responder que quiere ser de grande, </span> <br>
                    El sueño de Jhon es ser un policía <br>
                    Por el momento el no está en la escuela pasa en su casa po el virus. <br>
                    <span> Responder que le gusta hacer </span> <br>
                    Lo que mas le gusta hacer es jugar voly, pasear en la bicicleta  y las escondidas. <br>
                    <span> Responder que le gusta participar en la organización </span> <br>
                    <span> Childfund es una programa muy bonito a mi me encanta participar Jhon no  ha participado pero encantaría pintar hacer amigos modelar plastilina</span> <br>
                    <span> Responder como es su lugar donde vive. No dar direcciones. </span> <br>
                    Vivimos con nuestros padres y hermanos alejados de la ciudad, <br>
                     nuestro idioma es el español u quichua. <br>
                    <span> Responder que le gusta de comer:</span> <br>
                     el plato típico es el caldo de gallina papas con cuy y la colada morada <br>
                    Gracias por patrocinar a mi hermano Jhon le agradezco mucho por su amistad <br>
                    Hasta la próxima Att. Abdo Oyagato. <br>
                
                </p>
            @endif    
        @else
        <p class="text-lg-left font-weight-normal"  >
            
                Hola Donnielle Willear <span> (nombrar al patrocinador)</span> <br>
                Soy Abdon  <br>
                <span> Responder quienes son tus mejores amigos. </span> <br>
                Mis mejores amigos son mi hermano Yvan y Darwin porque juegan conmigo con mis carros <br>
                <span> Responder que quiero ser de grande, </span> <br>
                Mi sueño es ser un policía <br>
                Por el momento el no está en la escuela pasa en su casa po el virus. <br>
                <span> Responder te gusta hacer </span> <br>
                Lo que mas me gusta hacer es jugar voly, pasear en la bicicleta y las escondidas. <br>
                <span> Responder en que te gusta participar en la organización </span> <br>
                <span> Childfund es una programa muy bonito a mi me encanta participar encanta pintar hacer amigos modelar plastilina</span> <br>
                <span class="text-pink-600"> Responder como es su lugar donde vive. No dar direcciones. </span> <br>
                Vivo con mis padres y hermanos alejados de la ciudad, nuestro idioma es el español y quichua. <br>
                <span> Responder que le gusta de comer: </span> <br>
                Mi plato típico es el caldo de gallina papas con cuy y la colada morada <br>
                Gracias por patrocinar a mi hermano Jhon le agradezco mucho por su amistad <br>
                Hasta la próxima Att. Abdo Oyagato. <br>
        
        </p>
        @endif   
            
        </div> 
    </div>

 