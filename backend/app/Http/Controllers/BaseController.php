<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //Controle las response exitosas
    public function sendResponse($data, $http_status = 200)
    {
        //1. Construir la respuesta
        $respuesta = [
            "success" => true,
            "data" => $data
        ];
        //2. Enviar response afirmativa al cliente
        return response()->json($respuesta, $http_status);
    }

    //Controle las response fallidas
    public function sendError($errors, $http_status = 404)
    {
        //1. Construir la respuesta de error
        $respuesta = [
            "success" => false,
            "errors" => $errors
        ];
        //2. Enviar response error al cliente
        return response()->json($respuesta, $http_status);
    }
}
