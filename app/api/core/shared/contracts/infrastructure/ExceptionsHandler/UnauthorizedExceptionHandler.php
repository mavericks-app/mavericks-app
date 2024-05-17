<?php

namespace App\api\core\shared\contracts\infrastructure\ExceptionsHandler;
use App\api\core\shared\contracts\infrastructure\ExceptionsHandler\ExceptionsHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
class UnauthorizedExceptionHandler extends ExceptionsHandler
{

 public function __construct(\Exception $e, Request $request)
 {
     parent::__construct();
     $this->exception=$e;
     $this->request=$request;
     $this->response_code=401;
 }
public function getResponse(){

    $response = [
        'success' => false,
        'message'=>"Unauthorized"
    ];
    return response()->json($response, $this->response_code);

}

}
