<?php

namespace SCB\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ClienteController extends Controller{

    public function get_Cli(Request $data){
        $usr = $data['usr'];
        $res = DB::connection('cliente')->select('SELECT id_cliente from scb.clientes where usuario = ?',[$usr]);
        return $res[0]->id_cliente;

    }

    public function getCuentas(Request $data){
        $cli = $data['cli'];
        $res = DB::connection('cliente')->select('SELECT * from scb.CUENTAS where CLIENTE = ?',[$cli]);
        return $res;
    }

    public function getDes(Request $data){
        $des = $data['des'];
        $res = DB::connection('cliente')->select('SELECT * from scb.cuentas where folio = ?',[$des]);
        return $res;
    }

    public function postTransaccion(Request $data){
        $org = $data['org'];
        $des = $data['des'];
        $org_temp = $data['org'];
        $des_temp = $data['des'];
        $temp = DB::connection('cliente')->select('SELECT id_cuenta ori from scb.cuentas where folio = ?',[$org_temp]);
        $org = $temp[0]->ori;
        $temp = DB::connection('cliente')->select('SELECT id_cuenta ori from scb.cuentas where folio = ?',[$des_temp]);
        $des = $temp[0]->ori;
        $monto = $data['monto']; 
        DB::connection('cliente')->update('UPDATE scb.cuentas set saldo = saldo - ? where folio = ?',[$monto,$org_temp]);
        DB::connection('cliente')->update('UPDATE scb.cuentas set saldo = saldo + ? where folio = ?',[$monto,$des_temp]);
        DB::connection('cliente')->insert('INSERT into scb.transacciones(monto, origen, destino, fecha, tipo) values(?,?,?,sysdate,1)',[$monto,$org,$des]);
    }

    public function getAcum(Request $data){
        $cli = $data['cli'];
        $saldo = DB::connection('cliente')->select('select sum(cl.SALDO) final from scb.CUENTAS cl where cl.cliente = ? group by cl.CLIENTE ',[$cli]);
        return $saldo[0]->final;
    }

}