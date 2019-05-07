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
Route::post('/update_sucursal','AdminController@putSucursal');
Route::post('/delete_sucursal','AdminController@deleteSucursal');
Route::post('/post_cliente','AdminController@postCliente');
Route::post('/post_trabajador','AdminController@postTrabajador');
Route::post('/put_trabajador','AdminController@putTrabajador');
Route::post('/put_cliente','AdminController@putCliente');
Route::get('/get_cliente/{rfc}','AdminController@getCliente');
Route::get('/get_clientes','AdminController@getClientes');
Route::post('/delete_cliente','AdminController@deleteCliente');
Route::post('/delete_trabajador','AdminController@deleteTrabajador');
Route::get('/get_trabajadores_rol/{rol}','AdminController@getTrabajadoresRol');
Route::get('/get_cuentas_cliete/{cliente}','AdminController@getCuentas');
Route::post('/post_cuenta','AdminController@postCuenta');
Route::post('/delete_cuenta','AdminController@deleteCuenta');
Route::post('/put_cuenta','AdminController@putCuenta');
Route::get('/get_num_clientes','AdminController@getNumClientes');
Route::get('/get_num_usuarios','AdminController@getNumUsuarios');
Route::get('/get_num_trabajadores','AdminController@getNumtrabajadores');
Route::get('/get_num_cuentas','AdminController@getNumCuentas');
Route::get('/get_lista_clientes','AdminController@getListaClientes');
Route::get('/get_lista_tr','AdminController@getListaTrabajadores');
Route::post('/get_num_cliente','ClienteController@get_Cli');
Route::post('/get_cli_cu','ClienteController@getCuentas');
Route::post('/get_des','ClienteController@getDes');
Route::post('/post_transaccion','ClienteController@postTransaccion');
Route::post('/get_acum','ClienteController@getAcum');
Route::post('/get_montoT','CajeroController@get_montoT');
Route::post('/depositar','CajeroController@depositar');
Route::post('/get_transacciones','CajeroController@get_transacciones');
Route::post('/encuentra','CajeroController@encontrar');
Route::post('/montos','AdminController@montos');
Route::post('/fechas','AdminController@fechas');
Route::post('/ambos','AdminController@ambos');


