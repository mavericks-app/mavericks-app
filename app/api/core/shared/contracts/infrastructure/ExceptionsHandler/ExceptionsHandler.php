<?php

/*
Author: David
Fecha: 15/05/2024
*/

namespace App\api\core\shared\contracts\infrastructure\ExceptionsHandler;
use App\api\core\shared\contracts\infrastructure\ExceptionsHandler\DefaultExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

abstract class ExceptionsHandler
{
    protected $exception=null;
    protected $request=null;
    protected $response_code=400;

    public function __construct()
    {
    }
    abstract public function getResponse();

    public static function catch(\Exception $e, Request $request){

        //Manejador de cada exception
        if($e instanceof ValidationException){
            $catch= new ValidationExceptionHandler($e,$request);
        }
        else if($e instanceof UnauthorizedHttpException){
            $catch= new UnauthorizedExceptionHandler($e,$request);
        }
        else if($e instanceof NotFoundHttpException){
            $catch= new NotFoundHttpExceptionHandler($e,$request);
        }
        else{
            $catch= new DefaultExceptionHandler($e,$request);
        }

        return $catch->getResponse();
    }



}

