<?php

namespace App\Traits;




trait SendResponse
{
    public function sendGeneralResponse($success=true, $message ="", $redirect = "", $body= [], $code=200)
    {

        if(count($body) > 0){
            $response = [
                'success' => $success,
                'message' => $message,
                'redirect' => $redirect,
                'body' => $body,
            ];
        }else{
            $response = [
                'success' => $success,
                'message' => $message,
            ];
        }

        return response()->json($response, $code);
    }
    public function sendResponse($result, $token, $message, $redirect = 'home')
    {
        $response = [
            'success' => true,
            'token' => $token,
            'token_type' => 'Bearer',
            'data'    => $result,
            'message' => $message,
            'redirect' => $redirect,
        ];


        return response()->json($response, 200);
    }

    public function sendError($message, $errorMessages = [], $code = 200, $redirect = '')
    {
        $response = [
            'success' => false,
            'message' => $message,
            'redirect' => $redirect,

        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }


 

    public function sendResponseForRegisteration($message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'redirect' => "register",
        ];
        return response()->json($response, 200);

    }
}
