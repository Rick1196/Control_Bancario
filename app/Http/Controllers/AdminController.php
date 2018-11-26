<?php

namespace SCB\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller{
    public function getPaises(){
        $paises = DB::connection('admin')->select('SELECT * from scb.paises');
        return $paises;
    }

    public function getCiudades(Request $data){
        $pais = $data['pais'];
        $ciudades = DB::connection('admin')->select('SELECT * from scb.ciudades where pais = ?',[$pais]);
        return $ciudades;
    }

    public function getRoles(){
        $roles = DB::connection('admin')->select("SELECT * from scb.roles where name != ? ",['cliente']);
        return $roles;
    }

    public function getSucursales(Request $data){
        $ciudad = $data['ciudad'];
        $sucursales = DB::connection('admin')->select('SELECT * from scb.sucursales inner join scb.ciudades c2 on scb.sucursales.ciudad = c2.id_ciudad where ciudad = ?',[$ciudad]);
        return $sucursales;
    }

    public function getSucursal(Request $data){
        $ciudad = $data->input['ciudad'];
        $identificador = $data->input['id'];
        $sucursal = DB::connection('admin')->select('SELECT * from scb.sucursales inner join scb.ciudades c2 on scb.sucursales.ciudad = c2.id_ciudad where ciudad = ? and identificador = ?',[$ciudad, $identificador]);
        return $sucursal;
    }

    public function postSucursal(Request $data){
        $ciudad = $data['ciudad'];
        $identificador = $data['id'];
        DB::connection('admin')->insert('INSERT into scb.sucursales(ciudad,identificador_sucursal) values(?,?)',[$ciudad,$identificador]);
    }

    public function putSucursal(Request $data){
        $texto = $data['texto'];
        $id = $data['id'];
        DB::connection('admin')->update('UPDATE scb.sucursales set identificador_sucursal = ? where id_sucursal = ?',[$texto,$id]);
    }

    public function deleteSucursal(Request $data){
        $suc = $data['id'];
        DB::connection('admin')->update('DELETE from scb.sucursales where id_sucursal = ?',[$suc]);
    }

    public function postCliente(Request $data){
        $name = $data['name'];
        $mail = $data['mail'];
        $pass = $data['pass'];
        $pass =  bcrypt($pass);
        $rfc = $data['rfc'];
        $time = DB::connection('admin')->select("select to_char(systimestamp, 'YYYY-MM-DD HH24:MI:SS.FF1') time from dual");
        $time = $time[0]->time;
        $id = DB::connection('admin')->insert('INSERT into scb.users(name,email,password) values(?,?,?)',[$name,$mail,$pass]);
        $id = DB::connection('admin')->select('SELECT id from scb.users where name = ?',[$name]);
        $id = $id[0]->id;
        DB::connection('admin')->insert('INSERT INTO scb.clientes(RFC,usuario) values(?,?)',[$rfc,$id]);
        $rol = DB::connection('admin')->select('SELECT id from scb.ROLES where name = ?',['cliente']);
        $rol = $rol[0]->id;
        DB::connection('admin')->insert('INSERT INTO scb.role_user(role_id,user_id) values(?,?)',[$rol,$id]);
    }

    public function postTrabajador(Request $data){
        $name = $data['name'];
        $mail = $data['mail'];
        $pass = $data['pass'];
        $rol = $data['rol'];
        $pass =  bcrypt($pass);
        $rfc = $data['rfc'];
        $time = DB::connection('admin')->select("select to_char(systimestamp, 'YYYY-MM-DD HH24:MI:SS.FF1') tiempo from dual");
        $time = $time[0]->tiempo;
        DB::connection('admin')->insert('INSERT INTO scb.users(name,email,password) values(?,?,?)',[$name,$mail,$pass]);
        $id = DB::connection('admin')->select('SELECT id from scb.users where name = ?',[$name]);
        $id = $id[0]->id;
        DB::connection('admin')->insert('INSERT INTO scb.trabajadores(RFC,usuario,rol) values(?,?,?)',[$rfc,$id,$rol]);
        DB::connection('admin')->insert('INSERT INTO scb.role_user(role_id,user_id) values(?,?)',[$rol,$id]);
    }

    public function putTrabajador(Request $data){
        $name = $data['name'];
        $rfc = $data['rfc'];
        $usr = $data['usr'];
        $tr = $data['cl'];
        DB::connection('admin')->insert('UPDATE scb.users set name = ? where id = ?',[$name,$usr]);
        DB::connection('admin')->insert('UPDATE scb.trabajadores set RFC = ? where id_trabajador = ? ',[$rfc,$tr]);
    }

    public function putCliente(Request $data){
        $name = $data['name'];
        $rfc = $data['rfc'];
        $usr = $data['usr'];
        $tr = $data['cl'];
        DB::connection('admin')->insert('UPDATE scb.users set name = ? where id = ?',[$name,$usr]);
        DB::connection('admin')->insert('UPDATE scb.clientes set RFC = ? where id_cliente = ? ',[$rfc,$tr]);
    }

    public function getCliente(Request $data){
        $rfc = $data['rfc'];
        $cliente = DB::connection('admin')->select('SELECT * from scb.clientes where RFC = ?',[$rfc]);
        return $cliente;
    }

    public function getClientes(){
        $clientes = DB::connection('admin')->select('SELECT id_cliente,RFC,usuario,NAME,EMAIL from scb.clientes inner join scb.USERS on clientes.usuario = USERS.ID');
        return $clientes;
    }

    public function deleteCliente(Request $data){
        $cl = $data['cl'];
         DB::connection('admin')->delete('DELETE from scb.users where id = ?',[$cl]);
    }

    public function deleteTrabajador(Request $data){
        $id = $data['cl'];
         DB::connection('admin')->delete('DELETE from scb.users where id = ?',[$id]);
    }

    public function getTrabajadoresRol(Request $data){
        $rol = $data['rol'];
        $cliente = DB::connection('admin')->select('SELECT id_trabajador,U.NAME,EMAIL,rfc,DESCRIPTION, rol from scb.trabajadores inner join scb.ROLES on trabajadores.rol = ROLES.ID inner join scb.USERS U on trabajadores.usuario = U.ID where rol = ?',[$rfc]);
    }

    public function getCuentas(Request $data){
        $cliente = $data['cliente'];
        $cuentas = DB::connection('admin')->select('SELECT id_cuenta,id_cliente,folio,saldo,RFC from scb.cuentas inner join scb.clientes c2 on scb.cuentas.cliente = c2.id_cliente where id_cliente = ? order by saldo',[$cliente]);
        return $cuentas;
    }

    public function postCuenta(Request $data){
        $saldo = $data['saldo'];
        $cliente = $data['cliente'];
        $cl = strval($cliente);
        $res =  DB::connection('admin')->select("call scb.insertar_cuenta($saldo,'$cl',$cliente)");
        //DB::connection('admin')->select("call scb.insertar_cuenta(?,?,?)",[$saldo,$cliente,$cl]);
        return $res;
    }

    public function deleteCuenta(Request $data){
        $id = $data['id'];
        DB::connection('admin')->delete('DELETE from scb.cuentas where folio = ?',[$id]);
    }

    public function getNumClientes(){
        $clientes = DB::connection('admin')->select ('SELECT count(*) res from scb.clientes');
        return $clientes;
    }

    public function getNumUsuarios(){
        $clientes = DB::connection('admin')->select ('SELECT count(*) res from scb.users');
        return $clientes;
    }

    public function getNumtrabajadores(){
        $clientes = DB::connection('admin')->select ('SELECT count(*) res from scb.trabajadores');
        return $clientes;
    }

    public function getNumCuentas(){
        $clientes = DB::connection('admin')->select ('SELECT count(*) res from scb.cuentas');
        return $clientes;
    }

    public function getListaClientes(){
        $clientes = DB::connection('admin')->select('SELECT cl.ID_CLIENTE cliente, u.ID usuario, u.NAME nombre, cl.RFC rfc from scb.CLIENTES cl inner join scb.USERS u on cl.usuario = u.ID');
        return $clientes;
    }

    public function getListaTrabajadores(){
        $tr = DB::connection('admin')->select('SELECT u.ID usuario,tr.ID_TRABAJADOR trabajador, u.NAME nombre, tr.RFC rfc from scb.TRABAJADORES tr inner join SCB.USERS u on tr.USUARIO = u.ID');
        return $tr;
    }

    public function putCuenta(Request $data){
        $folio = $data['folio'];
        $saldo = $data['saldo'];
        DB::connection('admin')->update('UPDATE scb.cuentas set saldo = ? where folio = ?',[$saldo,$folio]);
    }


    


}