<?php

namespace SCB\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{

    //Get all the roles
    function get_roles(){
        $roles =  DB::select('SELECT * from roles order by id');
        return $roles;
    }
}
