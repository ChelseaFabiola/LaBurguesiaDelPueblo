<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Models\Burguesia;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\ComentarioController;
use App\Http\controllers\administrar;
use App\Http\controllers\cliente;
use App\Models\eventos;


// Route::get('/',function(){
//     return view("burguesia.index");
// });
Route::get('/', [ComentarioController::class,'index']);
Route::post('/',[ComentarioController::class,'store']);
// Route::post('/',function(){
//     print_r($_POST);
// });

Route::get('/menu',function(){

    return view("burguesia.menu");
});
Route::get('/menu',[cliente::class,"menucliente"]);


Route::get('/misionvision',function(){
    $eventos['eventos']=Eventos::all();

    return view("burguesia.misionvision",$eventos);
});
Route::get('/horarios', function(){
    return view('burguesia.horarios');
});
Route::get('/quienesSomos', function(){
        $eventos['eventos']=Eventos::all();

    return view('burguesia.quienesSomos',$eventos);
});


Route::get('/admin',[administrar::class,"index"]);
Route::get('/admin/misionvision',[administrar::class,"misionvision"]);
Route::get('/admin/horarios',[administrar::class,"horarios"]);
Route::get('/admin/menu',[administrar::class,"menu"]);

Route::post('/admin/menu/crearcategoria',[administrar::class,"storeindex"])->name('crearcategoria');

Route::delete('/admin/menu/{id}',[administrar::class,"eliminarCategoria"])->name('categorias.eliminar');
Route::post('/admin/menu',[administrar::class,"storeplatillo"])->name('platillo.crear');
// Route::post('/admin/menu',[administrar::class,"eliminarplatillo"])->name('platillo.eliminar');
Route::delete('/admin/menu/eliminar/{id}',[administrar::class,"eliminarplatillo"]);

Route::get('/admin/menu/editar/{id}',[administrar::class,"editarplatillo"]);
Route::PATCH('/admin/menu/editar/{id}',[administrar::class,"updateplatillo"]);

Route::get('/admin/crearplatillo',[administrar::class,"crearplatillo"]);

Route::get('/admin/misionvision/editar/{id}', [administrar::class, 'updateEvento']);
Route::patch('/admin/misionvision/editar/{id}', [administrar::class, 'updateEvento']);
Route::get('/carrito', function () {
    return view('burguesia.carrito');
})->name('carrito');


Route::get('/admin/quienesSomos',[administrar::class,"quienesSomos"]);

Route::get('/admin/quienesSomos/editar/{id}',[administrar::class,"updatequienessomos"]);
Route::patch('/admin/quienesSomos/editar/{id}',[administrar::class,"updatequienessomos"]);



Route::post('/admin/create/galeria',[administrar::class,"storegaleria"]);
Route::delete('/admin/galeria/eliminar/{id}',[administrar::class,"eliminargaleria"]);


Route::post('/validar-comentario/{id}', [administrar::class, 'validarComentario'])->name('estatus.comentario');

Route::delete('/eliminar-comentario/{id}', [administrar::class, 'eliminarComentario'])->name('eliminar.comentario');



//agrege esto
Route::get('/inicioSesion', function(){
    return view('administrar.inicioSesion');
});