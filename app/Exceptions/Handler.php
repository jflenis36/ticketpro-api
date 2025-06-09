<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
     /**
      * A list of the exception types that are not reported.
      *
      * @var array<int, class-string<Throwable>>
      */
     protected $dontReport = [
          //
     ];

     /**
      * A list of the inputs that are never flashed for validation exceptions.
      *
      * @var array<int, string>
      */
     protected $dontFlash = [
          'current_password',
          'password',
          'password_confirmation',
     ];

     /**
      * Register the exception handling callbacks for the application.
      *
      * @return void
      */
     public function register()
     {
          $this->reportable(function (Throwable $e) {
               //
          });
     }

     public function render($request, Throwable $exception)
     {
          if ($request->expectsJson()) {

               if ($exception instanceof NotFoundHttpException) {
                    return response()->json([
                         'ok' => false,
                         'status' => 'error',
                         'code' => 404,
                         'message' => 'La ruta solicitada no existe.',
                         'errors' => null
                    ], 404);
               }

               if ($exception instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                         'ok' => false,
                         'status' => 'error',
                         'code' => 405,
                         'message' => 'Método no permitido para esta ruta.',
                         'errors' => null
                    ], 405);
               }

               if ($exception instanceof ValidationException) {
                    return $this->invalidJson($request, $exception);
               }
          }

          return parent::render($request, $exception);
     }

     public function invalidJson($request, ValidationException $exception)
     {
          $mensajes = collect($exception->errors())->flatten()->implode(' ');

          return response()->json([
               'ok' => false,
               'status' => 'error',
               'code' => 401,
               'message' => $mensajes,
               'errors' => null,
          ], 401);
     }
}
