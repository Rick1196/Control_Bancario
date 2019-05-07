<?php

namespace SCB\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CajeroController extends Controller{

    public function get_transacciones(Request $data){
        $fol = $data['folio'];
        $res = DB::connection('cajero')->select('SELECT c2.folio fol, transacciones.monto mon, transacciones.fecha fecha from transacciones inner join scb.cuentas  c2 on transacciones.destino = c2.id_cuenta where c2.FOLIO = ? order by transacciones.fecha asc',[$fol]);
        return $res;
    }

    public function  get_montoT(Request $data){
        $fol = $data['folio'];
        $res = DB::connection('cajero')->select('SELECT sum(scb.transacciones.monto) montoT from scb.transacciones inner join scb.cuentas  c2 on scb.transacciones.destino = c2.id_cuenta where c2.FOLIO = ? group by (c2.folio)',[$fol]);
        return $res;
    }

    public function depositar(Request $data){ 
        $fol = $data['folio'];
        $monto = $data['monto'];
        $temp = DB::connection('cliente')->select('SELECT id_cuenta ori from scb.cuentas where folio = ?',[$fol]);
        $org = $temp[0]->ori;
        DB::connection('cajero')->update('UPDATE scb.cuentas set saldo = saldo + ? where folio = ?',[$monto,$fol]);
        DB::connection('cajero')->insert('INSERT into scb.transacciones(monto, origen, fecha, tipo) values(?,?,sysdate,1)',[$monto,$org]);
    }

    public function encontrar(Request $data){
        $fol = $data['folio'];
        $res = DB::connection('cajero')->select('SELECT folio from scb.cuentas where folio = ?',[$fol]);
        return $res;
    }

}