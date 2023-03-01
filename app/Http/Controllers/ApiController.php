<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Se crea el controlador de la Api
class ApiController extends Controller
{
    
    //Funcion enviar los datos del formulario
    public function formulario(Request $request){
        
        $input = $request->all();
        //Se retorna el array de todos los usuarios
        return $input;
    }
}
