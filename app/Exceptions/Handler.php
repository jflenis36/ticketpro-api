<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Clase Handler para el manejo de excepciones de la aplicación
 * 
 * Esta clase extiende el ExceptionHandler de Laravel y personaliza
 * el manejo de excepciones para la API
 */
class Handler extends ExceptionHandler
{
     /**
      * Lista de tipos de excepciones que no deben ser reportadas.
      * 
      * @var array<int, class-string<Throwable>>
      */
     protected $dontReport = [
          //
     ];

     /**
      * Lista de inputs que nunca deben ser flasheados en las excepciones de validación.
      * 
      * @var array<int, string>
      */
     protected $dontFlash = [
          'current_password',
          'password',
          'password_confirmation',
     ];

     /**
      * Registra los callbacks de manejo de excepciones para la aplicación.
      * 
      * @return void
      */
     public function register()
     {
          $this->reportable(function (Throwable $e) {
               //
          });
     }

     /**
      * Renderiza la excepción en una respuesta HTTP.
      * 
      * @param  \Illuminate\Http\Request  $request
      * @param  \Throwable  $exception
      * @return \Symfony\Component\HttpFoundation\Response
      */
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

     /**
      * Convierte una excepción de validación en una respuesta JSON.
      * 
      * @param  \Illuminate\Http\Request  $request
      * @param  \Illuminate\Validation\ValidationException  $exception
      * @return \Illuminate\Http\JsonResponse
      */
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
