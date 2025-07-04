<?php

class ResponseService {

    public static function success_response($payload){
        $response = [];
        $response["status"] = 200;
        $response["payload"] = $payload;
        return json_encode($response);
    }

    public static function notFound_response($payload){
        $response = [];
        $response["status"] = 404;
        $response["payload"] = $payload;
        return json_encode($response);
    }

    public static function unauthorized_response($payload){
        $response = [];
        $response["status"] = 401;
        $response["payload"] = $payload;
        return json_encode($response);
    }
    
}