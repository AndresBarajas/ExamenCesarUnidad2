<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\EstudianteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});

/* toma el nombre como una ruta y lo imprime en la pagina*/

/* toma el nombre como una ruta y lo imprime en la pagina*/
/*
Route::get('/edad/{edad}',function($edad){
    if ($edad <=100 and $edad >=0){
        if ($edad>=18){
            return 'es mayor de edad :)';
        };

        return 'eres menor de edad :(';
    };
        return "ERROR esta pinche edad no existe";
});
*/

/* Se muestra los datos en el postman de la url de la pagina*/
Route::post('/obtener', function  ()  {
    return 'se obtiene los datos del carrito';
});

Route::post('/crear', function  ()  {
    return 'se crea un nuevo carrito';
});

Route::post('/modificar/{id}', function  ()  {
    return 'se modifico el carrito';
});

Route::post('/borrar', function  ()  {
    return 'se elimino el carrito';
});









Route::get('/estudiantes/estadisticas',[EstudianteController::class,'ObtainStats']);






//Route::get('/login/{email}/{password}',[LoginController::class, 'login']);



/* creacion de las rutas*/
Route::post('/ventas', [VentaController::class,'create']);
Route::get('/ventas', [VentaController::class,'obtain']);
Route::delete('/ventas', [VentaController::class,'delete']);


/* creacion de las rutas*/
Route::get('/usuarios', [UserController::class,'obtain']);
Route::post('/usuarios', [UserController::class,'create']);
Route::put('/usuarios/{id}',[UserController::class,'modify']);
Route::delete('/usuarios/{id}', [UserController::class,'delete']);

/* creacion de las rutas*/
Route::get('/productos', [ProductosController::class,'obtain']);
Route::post('/productos', [ProductosController::class, 'create']);
Route::put('/productos/{id}',[ProductosController::class,'modify']);
Route::delete('/productos/{id}',[ProductosController::class,'delete']);

Route::post('/login',[LoginController::class, 'login']);

Route::put('/usuarios/{id}', [UserController::class,'update']);
Route::put('/usuarios/create/{id}', [UserController::class,'examen']);
