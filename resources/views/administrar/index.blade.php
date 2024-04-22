@include('administrar.header')


{{-- justify-content-center text-center --}}
<style>
    .comentario-container {
        margin-bottom: 20px;
    }

    .comentario-content {
        flex-grow: 1;
        background-color: #FFFFFF;
        border-radius: 10px;
        color: #000000;
        padding: 10px;
    }

    .comentario-content .fecha {
        color: #888888;
        /* Color de la fecha más gris */
    }

    .comentario-content .estrellas {
        color: #FFC300;
        /*color de las estrellitas */
    }

    .user-icon {
        /* Fondo con degradado */
        background: linear-gradient(50deg, #0044ff, #00ccff);
        /* Color del muñeco de usuario blanco */
        color: white;
        /* Forma circular */
        border-radius: 50%;
        /* Para centrar verticalmente */
        display: inline-flex;
        align-items: center;
        /* Para centrar horizontalmente */
        justify-content: center;
        /* Ancho y altura del círculo */
        width: 50px;
        height: 50px;
        /* Espaciado dentro del círculo */
        padding: 5px;
        box-shadow: 0 0 6px #0044ff;
        /* Cambia el valor para ajustar el brillo */
        

    }
    .card {
        height: 100%; /* Establecer altura fija para todas las tarjetas */
    }
    .card-img-top {
        height: 200px; /* Altura deseada para las imágenes dentro de las tarjetas */
        object-fit: cover; /* Ajustar la imagen dentro de la altura fija de la tarjeta */
    }
    .card-body {
        height: calc(100% - 200px); /* Calcular el espacio restante para el cuerpo de la tarjeta */
        overflow: auto; /* Agregar barra de desplazamiento si el contenido es más largo que la altura */
    }

   
</style>
<br><br>
<!--<div class="text-center">-->
    <!--le cambie la escala a 75%-->
    <!--tambien le puse style="border:0; border-radius: 20px;"-->
   <!-- <video src="img/LaBurguesiaDelPueblo(HD).mp4" class="object-fit-scale" width="75%" autoplay controls muted
        style="border:0; border-radius: 15px;"></video>
</div>-->

<!--agrege brs-->
<br><br><br>

<!--sliders-->
<!--agrege tambien rounded-->
<!--<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div id="carouselExample" class="carousel slide rounded" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($imagenes as $imagen)
                        <div class="carousel-item active">
                            <img src="/storage/{{ $imagen->foto }}" class="d-block w-100 rounded" alt="..." style="height: 500px;object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>-->
        <!--mapa-->
        <!--le cambie los borde de las puntas con rounded y border-radius etc tambien cambie el tamaño del mapa-->
       <!-- <div class="col-md-5">
            <div class="text-center rounded">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15118.796060141516!2d-88.389356!3d18.6774977!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5bb19cacac039d%3A0xf78e6e0a829b436a!2sLa%20Burgues%C3%ADa%20del%20Pueblo!5e0!3m2!1ses!2smx!4v1710813132548!5m2!1ses!2smx"
                    width="100%" height="495" style="border:0; border-radius: 15px;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>-->

<!--agrege brs-->
<br><br><br><br>


<div class="text-center justify-content-center">
    <div class="container">
        <h2>——— Galería de imágenes ———</h2>
        <div class="row">
            @foreach ($imagenes as $imagen)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="/storage/{{ $imagen->foto }}" alt="">
                        <div class="card-body">
                            <form action="{{ url('/admin/galeria/eliminar', $imagen->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-outline-danger" type="submit" value="Eliminar" onclick="return confirm('¿Quieres borrar esta imagen?')">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cargar Imagen</h5>
                        <form action="{{ url('/admin/create/galeria') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="foto">Seleccionar Imagen</label>
                                <input type="file" class="form-control-file" name="foto" id="foto">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-outline-primary">Subir Imagen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!--ventana flotante Contactos-->
    <!--<div id="ventanaFlotante" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4>Contactenos en:</h4>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <img class="imgVentana" src="img/burguesia.jpeg" alt="BP La Burguesía del Pueblo" width="100px"
                            height="150px">
                    </div>

                    <div class="col-7">
                        <br>
                        <div class="contact-info">
                            <img src="img/whatsapp.png" alt="WhatsApp" class="contact-icon">
                            <p>983 120 8934</p>
                        </div>
                        <div class="contact-info">
                            <img src="img/gmail.png" alt="Gmail" class="contact-icon">
                            <p>laburguesia.bacalar@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!--ventana flotante contactos-->

    <!--ventana flotante Horarios-->
    <!--<div id="ventanaFlotanteHorario" class="ventana">
        <div id="modalHorario"class="modal-content">
            <span class="close">&times;</span>
            <h4>Horarios:</h4>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Columna 1</th>
                                        <th>Columna 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Fila 1, Columna 1</td>
                                        <td>Fila 1, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 2, Columna 1</td>
                                        <td>Fila 2, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 3, Columna 1</td>
                                        <td>Fila 3, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 4, Columna 1</td>
                                        <td>Fila 4, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 5, Columna 1</td>
                                        <td>Fila 5, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 6, Columna 1</td>
                                        <td>Fila 6, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 7, Columna 1</td>
                                        <td>Fila 7, Columna 2</td>
                                    </tr>
                                    <tr>
                                        <td>Fila 8, Columna 1</td>
                                        <td>Fila 8, Columna 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!--ventana flotante Horarios-->


    <!--comentarios-->
    <br><br><br>
    <!--modificado-->
    <div id="comentarios">
        <h3>Comentarios recientes</h3>
    </div>


    {{-- comentarios funcionales --}}

    @foreach ($comentarios as $comentario)
    <div class="container mt-4 col-7">
        <div class="row">
            <div class="col">
                <div class="d-flex comentario-container">
                    <div class="me-3">
                        <span class="user-icon">
                            <i class="fas fa-user fa-2x"></i> <!-- Icono de persona -->
                        </span>
                    </div>
                    <div class="border p-3 comentario-content">
                        <p style="text-align: left; margin-bottom: 0px;"><strong>{{ $comentario->nombre }}</strong></p>
                        <p class="fecha" style="text-align: left; margin-bottom: 5px;">
                            {{ $comentario->created_at->format('d \d\e F \d\e\l Y, H:i') }}</p>
                        <hr style="margin-bottom: 5px;">
                        <p class="estrellas" style="text-align: left; margin-bottom: 4px;">{!! str_repeat('&#9733;', $comentario->puntuacion) !!}</p>
                        <p style="text-align: left; margin-bottom: 2px;">{{ $comentario->comentario }}</p>
                        <div class="d-inline">
                            @if ($comentario->estatus==0)
                            <form action="{{ route('estatus.comentario', $comentario->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">Validar Comentario</button>
                            </form>
                            @endif
                            <form action="{{ route('eliminar.comentario', $comentario->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar Comentario</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


    {{-- 
<br>
    <!-- Comentario Falso -->
<div class="container mt-4 col-7">
    <div class="row">
        <div class="col">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-user fa-2x"></i> <!-- Icono de persona -->
                </div>
                <div class="border p-3">
                    <p class="mb-0"><strong>Usuario123:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget justo nec libero ullamcorper lacinia. Sed ut libero nec justo ultricies tincidunt. Donec non enim a odio malesuada tristique.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    <!-- Comentario Falso -->
<div class="container mt-4 col-7">
    <div class="row">
        <div class="col">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-user fa-2x"></i> <!-- Icono de persona -->
                </div>
                <div class="border p-3">
                    <p class="mb-0"><strong>Usuario123:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget justo nec libero ullamcorper lacinia. Sed ut libero nec justo ultricies tincidunt. Donec non enim a odio malesuada tristique.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    <!-- Comentario Falso -->
<div class="container mt-4 col-7">
    <div class="row">
        <div class="col">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-user fa-2x"></i> <!-- Icono de persona -->
                </div>
                <div class="border p-3">
                    <p class="mb-0"><strong>Usuario123:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget justo nec libero ullamcorper lacinia. Sed ut libero nec justo ultricies tincidunt. Donec non enim a odio malesuada tristique.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    @include('administrar.footer')
