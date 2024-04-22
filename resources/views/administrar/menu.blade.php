@include('administrar.header')


<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <!-- Barra lateral izquierda para categorías -->
        <div class="col-lg-3">
            <div class="list-group">
                <!-- Filtros por precio -->
                <div class="list-group-item">
                    <h5 class="mb-3">Filtrar por precio:</h5>
                    <button onclick="filterByPrice('asc')" class="btn btn-secondary">Más Barato</button>
                    <button onclick="filterByPrice('desc')" class="btn btn-secondary">Más Caro</button>
                    <br><br><hr>
                    <a class="btn btn-secondary" href="{{ url('/admin/crearplatillo') }}">Nuevo platillo</a>
                    <form action="{{url('/admin/menu/crearcategoria')}}" method="POST">
                        @csrf
                        <label for="nombre">categoria</label><br>
                        <input type="text" name='nombre' id="nombre">
                        <input type="submit" class="btn btn-secondary" value="Nueva categoria">
                    </form>
                </div>
                <!--<div id="categoryLinks" class="list-group" style="position: fixed; top:2; left: 0;">-->
                @foreach ($lista as $categoria)
                <div class="d-flex justify-content-between">
                    <a href="#" class="list-group-item list-group-item-action"
                        onclick="showCategory('{{ $categoria->nombre }}')"
                        style="background-color: #9CA64E;">{{ $categoria->nombre }}</a>
                    <form class="" action="{{ route('categorias.eliminar', $categoria->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="🗑️"
                            onclick="return confirm('¿Quieres borrar esta categoria?')">
                    </form>
                </div>
                    
                @endforeach
                <!--</div>-->
                <!-- Agrega más categorías según sea necesario -->
                
            </div>
        </div>
        <!-- Contenido principal con cards -->
        <div class="col-lg-9">
            <!-- Título de la categoría seleccionada -->
            <br>
            <h2 class="text-center" id="categoriaSeleccionada"></h2>
            <br>
            <div id="menuContent">
                <!-- Aquí se mostrarán los platillos de la categoría seleccionada -->
            </div>
        </div>
    </div>
</div>



<script>
    // Define un objeto con los platillos por categoría
    var menuItems = {
        @foreach ($lista as $categoria)
            '{{ $categoria->nombre }}': [ //entradas
                @foreach ($platillos as $platillo)
                    @if ($categoria->nombre == $platillo->categoria)
                        {
                            id: '{{ $platillo->id }}',
                            titulo: '{{ $platillo->nombre }}',
                            descripcion: '{{ $platillo->descripcion }}',
                            imagen: '{{ $platillo->imagen }}',
                            precio: '{{ $platillo->precio }}'

                        },
                    @endif
                @endforeach
                


            ],
        @endforeach


        // Agrega más categorías según sea necesario
        
    };



    // Función para mostrar los platillos de una categoría específica
    function showCategory(category) {
        var menuHTML = '';
        // Obtiene los platillos de la categoría seleccionada
        var items = menuItems[category];
        // Actualiza el título de la categoría seleccionada
        document.getElementById('categoriaSeleccionada').innerText = getCategoryName(category);
        // Genera el HTML de los cards para cada platillo
        for (var i = 0; i < items.length; i++) {
    let id = items[i].id;
    let titulo = items[i].titulo;
    let desc = items[i].descripcion;
    let imgPath = items[i].imagen;
    let precio = items[i].precio;

    if (i % 3 === 0) {
        menuHTML += '<div class="row">';
    }
    menuHTML += '<div class="col-md-4 mb-4">';
    menuHTML += '<div class="card" style="background-color: #D9D9D9; border: 3px solid #ffffff;">';
    menuHTML += '<div class="card-body d-flex flex-column justify-content-between">';
    menuHTML += '<h5 class="card-title text-center mb-4">' + titulo + '</h5>';
    menuHTML += '<p class="card-text">' + desc + '</p>';
    menuHTML += '<img src="/storage/' + imgPath +
        '" class="card-img-top mx-auto" alt="..." style="max-width: 150px; height: auto; border: 4px solid white;">';
    menuHTML += '<h6 class="card-text mt-2">Precio: $' + precio + '</h6>';
    menuHTML += '<div class="d-flex justify-content-between">';
    menuHTML += '<a href="/admin/menu/editar/' + id + '" class="btn btn-info">Editar</a>';
    menuHTML += '<form action="/admin/menu/eliminar/' + id + '" method="POST">';
    menuHTML += '@csrf';
    menuHTML += '@method('DELETE')';
    menuHTML += '<button type="submit" class="btn btn-danger" onclick="return confirm(\'¿Quieres borrar el plato '+titulo+'?\')">Eliminar</button>';
    menuHTML += '</form>';
    menuHTML += '</div>'; // Cierre del div que contiene los botones
    menuHTML += '</div></div></div>';
    if ((i + 1) % 3 === 0 || i === items.length - 1) {
        menuHTML += '</div>';
    }
}
        // Muestra los cards en el contenedor correspondiente
        document.getElementById('menuContent').innerHTML = menuHTML;
    }

    function agregarACarrito(id, titulo, desc, img, precio) {
        var platillo = {
            "id": id,
            "titulo": titulo,
            "desc": desc,
            "img": img,
            "precio": precio,
            "cantidad": 1,
        };

        let cart = sessionStorage.getItem('cart');

        if (cart != null) {
            var productos = JSON.parse(cart);

            var productosEncontrados = productos.filter(function(producto) {
                return producto.id == id;
            });

            if (productosEncontrados.length == 0) {
                productos.push(platillo);
                var platillosJSON = JSON.stringify(productos);
                // Guardar la cadena JSON en sessionStorage
                sessionStorage.setItem('cart', platillosJSON);
                console.log(productos);

            }

        } else {
            var platillos = [platillo];
            var platillosJSON = JSON.stringify(platillos);

            // Guardar la cadena JSON en sessionStorage
            sessionStorage.setItem('cart', platillosJSON);
        }



    }

    // Retorna el nombre de la categoría dado su identificador
    function getCategoryName(category) {
        switch (category) {
            @foreach ($lista as $categoria)
                case '{{ $categoria->nombre }}':
                return '{{ $categoria->nombre }}';
            @endforeach
        }
    }

    // Llamar a showCategory con la primera categoría por defecto cuando se carga la página
    window.onload = function() {
        showCategory('{{ $lista[0]->nombre }}');
    }
</script>


{{-- 
<script>
    // Define un objeto con los platillos por categoría
    var menuItems = {
        @foreach ($lista as $categoria)
            '{{ $categoria->nombre }}': [ //entradas
                @foreach ($platillos as $platillo)
                    @if ($categoria->nombre == $platillo->categoria)
                    {
                        id: '{{$platillo->id}}',
                        titulo: '{{$platillo->nombre}}',
                        descripcion: '{{$platillo->descripcion}}',
                        imagen: '{{$platillo->imagen}}',
                        precio: '{{$platillo->precio}}'

                    },
                    @endif
                @endforeach
            ],
        @endforeach
        
        // Agrega más categorías según sea necesario
    };

    // Función para mostrar los platillos de una categoría específica
    function showCategory(category) {
    var menuHTML = '';
    // Obtiene los platillos de la categoría seleccionada
    var items = menuItems[category];
    // Actualiza el título de la categoría seleccionada
    document.getElementById('categoriaSeleccionada').innerText = getCategoryName(category);
    // Genera el HTML de los cards para cada platillo
    for (var i = 0; i < items.length; i++) {
        if (i % 3 === 0) {
            menuHTML += '<div class="row">';
        }
        menuHTML += '<div class="col-md-4 mb-4">';
        menuHTML += '<div class="card" style="background-color: #BEA899; border: 4px solid #9F625B;">';
        menuHTML += '<div class="card-body d-flex flex-column justify-content-between">';
        menuHTML += '<h5 class="card-title text-center mb-4">' + items[i].titulo + '</h5>';
        menuHTML += '<p class="card-text">' + items[i].descripcion + '</p>';
        menuHTML += '<img src="storage/' + items[i].imagen +'" class="card-img-top mx-auto" alt="..." style="max-width: 150px; height: auto; border: 4px solid white;">'; // Establece el ancho máximo deseado para las imágenes (por ejemplo, 150px)
        menuHTML += '<h6 class="card-text mt-2">Precio: ' + items[i].precio + '</h6>';
        menuHTML +=
            '<a href="#" class="btn btn-success mx-auto" style="background-color: #9CA64E;">Agregar</a>'; // Botón centrado horizontalmente con estilo de fondo
        menuHTML += '</div></div></div>';
        if ((i + 1) % 3 === 0 || i === items.length - 1) {
            menuHTML += '</div>';
        }
    }
    // Muestra los cards en el contenedor correspondiente
    document.getElementById('menuContent').innerHTML = menuHTML;
}

// Retorna el nombre de la categoría dado su identificador
function getCategoryName(category) {
    switch (category) {
        @foreach ($lista as $categoria)
            case '{{ $categoria->nombre }}':
            return '{{ $categoria->nombre }}';
        @endforeach
    }
}

// Llamar a showCategory con la primera categoría por defecto cuando se carga la página
window.onload = function() {
    showCategory('{{ $lista[0]->nombre }}');
}


</script> --}}







{{-- <br><br><br><br>



<h3>categorias:</h3>
<ul>
    @foreach ($lista as $categoria)
        <li>{{$categoria->nombre}}</li>
        <form action="{{route('categorias.eliminar',$categoria->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Eliminar" onclick="return confirm('¿Quieres borrar esta categoria?')">
        </form>
    @endforeach
</ul>
<form action="{{url('/admin/menu/crearcategoria')}}" method="POST">
    @csrf
    <label for="nombre">categoria</label><br>
    <input type="text" name='nombre' id="nombre"><br>
    <input type="submit" value="Insertar categoria">
</form>
<h2>platillos:</h2>
@foreach ($platillos as $platillo)
        <ul>
            <li>{{$platillo->nombre}}</li>
            {{-- php artisan storage:link --}}
{{-- <img src="{{asset('storage').'/'.$platillo->imagen}}" alt="" width="100">
            <li>{{$platillo->imagen}}</li>
            <li>{{$platillo->descripcion}}</li>
            <li>{{$platillo->precio}}</li>
            <li>{{$platillo->categoria}}</li>
            <a href="{{url('/admin/menu/editar/'.$platillo->id)}}">Editar</a>
            <form action="{{url('/admin/menu/eliminar/'.$platillo->id)}}" method="POST">@csrf,@method('DELETE')<input type="submit" value="X" onclick="return confirm('¿Quieres borrar este platillo?')"></form>
        </ul> --}}

{{-- @endforeach --}}

@include('administrar.footer')
