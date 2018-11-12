<?php

namespace SCB\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller{
    public function getPaises(){
        $paises = DB::connection('admin')->select('SELECT * from scb.paises');
        return $paises;
    }
}