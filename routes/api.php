<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get_roles','AdminController@getRoles');
Route::get('/get_paises','AdminController@getPaises');
Route::get('/get_ciudades/{pais}','AdminController@getCiudades'); 
Route::get('/get_sucursal/{ciudad}/{id}','AdminController@getSucursal');
Route::get('/get_sucursales/{ciudad}','AdminController@getSucursales');
Route::post('/post_sucursal','AdminController@postSucursal');
Route::put('/update_sucursal/{ciudad}/{id}','AdminController@putSucursal');
Route::delete('/delete_sucursal/{id}','AdminController@deleteSucursal');
Route::post('/post_cliente','AdminController@postCliente');
Route::post('/post_trabajador','AdminController@postTrabajador');
Route::put('/put_trabajador','AdminController@putTrabajador');
Route::put('/put_cliente','AdminController@putCliente');
Route::get('/get_cliente/{get}','AdminController@getCliente');
Route::get('/get_clientes','AdminController@getClientes');
Route::delete('/delete_cliente/{id}','AdminController@deleteCliente');
Route::delete('/delete_trabajador/{id}','AdminController@deleteTrabajador');
Route::get('/get_trabajadores_rol/{rol}','AdminController@getTrabajadoresRol');