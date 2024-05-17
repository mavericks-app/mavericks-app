<?php

namespace App\api\core\shared\contracts\infrastructure\ExceptionsHandler;
use App\api\core\shared\contracts\infrastructure\ExceptionsHandler\ExceptionsHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
class DefaultExceptionHandler extends ExceptionsHandler
{

 public function __construct(\Exception $e, Request $request)
 {
     parent::__construct();
     $this->exception=$e;
     $this->request=$request;
 }
public function getResponse(){

    $response = [
        'success' => false,
        'message' => $this->exception->getMessage(),
    ];
    return response()->json($response, $this->response_code);
}


}
