<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {
        return parent::render($request, $exception);
        // if ($exception instanceof NotFoundHttpException) {
        //     return response()->json(['message' => 'Url not found'], 404);
        // }
        // if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        //     return response()->json(['Token is invalid'], 401);
        // }
        // if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        //     return response()->json(['Token has expired'], 401);
        // }
        // $response = parent::render($request, $exception);
        // if ($request->is('api/*')) {
        //     app('Asm89\Stack\CorsService')->addActualRequestHeaders($response, $request);
        // }
        // return $response;
    }

    protected function unauthenticated($request, AuthenticationException $exception) {
        return $request->expectsJson()
        ? response()->json(['message' => $exception->getMessage()], 401)
        : redirect()->guest(route('login'));
    }
}
