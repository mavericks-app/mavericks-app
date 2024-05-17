<?php

namespace App\api\core\shared\contracts\infrastructure\ExceptionsHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
class ValidationExceptionHandler extends ExceptionsHandler
{

 public function __construct(\Exception $e, Request $request)
 {
     parent::__construct();
     $this->exception=$e;
     $this->request=$request;
 }
public function getResponse(){

    // Si la validación falla, maneja el error aquí
    $errors = $this->exception->validator->errors()->toArray();

    $response = [
        'success' => false,
        'message'=>"Validation",
        'errors' => $errors,
    ];
    return response()->json($response, $this->response_code);

}

}
