<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioRequest;
use Illuminate\Http\Request;
use File;

//Se crea el controlador de la Api
class ApiController extends Controller
{
    
    //Funcion enviar los datos del formulario
    public function formulario(Request $request){
        
        $input = $request->all();
        

        //Se asignan variables de los parametros
        $nombre = $input['nombre'];
        $apellido = $input['apellido'];
        $telefono = $input['telefono'];
        $correo = $input['correo'];

        //Mensaje de error en caso de de que el correo sea erroneo
        if($correo == 'john@smith.com'){

            $response['error'] = true;
            $response['message'] = "El siguiente correo $correo es un correo que no se acepta.";

            return $response;
        }

        $vocales = array('a', 'e', 'i', 'o', 'u', 'á', 'é', 'í', 'ó', 'ú');

        //Sacando las vocales del nombre
        $lowname = strtolower($nombre);
        $name_palabras = mb_str_split($lowname);
        $vocales_nombre = array();
        foreach($name_palabras as $vocalname){
            if(in_array($vocalname, $vocales)){
                array_push($vocales_nombre, $vocalname);
            }
        }
        $name_vocales = implode($vocales_nombre); //vocales del nombre
        $palabra_uno = strtolower($apellido[0]); //primera palabra del apellido
        $ultima_palabra = mb_substr($apellido, -1); //ultima palabra del apellido
        $numero_random = strval(mt_rand(100,999)); //numero aleatorio

        $token = $name_vocales . $palabra_uno . $ultima_palabra . $numero_random;

        $response['error'] = false;
        $response['message'] = "Se insertaron los datos del formulario correctamente";
        $response['token'] = $token;

        //Datos del json
        $json_data['nombre'] = $nombre;
        $json_data['apellido'] = $apellido;
        $json_data['telefono'] = $telefono;
        $json_data['correo'] = $correo;
        $json_data['token'] = $token;
  
        $fileName = time() . '_datos_formulario.json';
        $fileStorePath = public_path('/upload/json/'.$fileName);
  
        File::put($fileStorePath, json_encode($json_data));

        return $response;
    }
}
