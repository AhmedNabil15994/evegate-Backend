<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        \League\OAuth2\Server\Exception\OAuthServerException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
    
         if($request->expectsJson() || $request->wantsJson() || $request->ajax() ){

         
             if($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException &&  $exception->getStatusCode() == 403 ){
                 return $this->errorApi("Not authorized", 403, []);
             }

              if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException ) {
                 return $this->errorApi("Not authorized" ,403);
             }

             if ($exception instanceof ModelNotFoundException ) {
                 return $this->errorApi("Not found ",404);
             }
         }
        //  dd(auth()->logout());
        return parent::render($request, $exception);
    }


    public function errorApi($error,  $code = 200, $errorMessages = [])
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
