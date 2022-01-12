

    <div class="container1">
        <br>
        <br>
        @php
        $date = (\Carbon\Carbon::now());
        @endphp

    <div class="card p-4 mt-2 dosdr">
        <p>Fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</p>
            <p class="text-lg-left font-weight-normal"  >

                Hola querido amigo ejemplo <span> (debe mencionar al patrocinador) </span> Jerry Corns 
                te saluda tu amiga Fernanda esperando que te encuentres bien de salud
                 con toda tu familia ante esta pandemia,
                <span> Ejemplo: Agradecer cuanto recibió de regalo: </span> 
                Quiero agradecer por tus $ 30 que me has enviado. 
                <span> Responder que se va a comprar con el dinero: </span> 
                Con este dinero mis padres van a comprar vivieres para poder alimentarnos.
                Te cuento que el día 17 de junio cumplí 14 años y la celebramos con toda mi 
                familia. Y también te cuento que todos los domingos jugamos futbol en la casa
                 de mi tía. Ya mismo finalizo clases acá en Ecuador. 
                El día 7 de julio va a ser la entrega de los portafolios.
                Me despido con mucho cariño tu amiga Fernanda Rodríguez. Cuídate mucho. 
            </p>
            
        </div> 
    </div>

 