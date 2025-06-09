<?php

namespace App\Traits;

/**
 * Trait ApiResponse
 * 
 * Este trait proporciona métodos estandarizados para formatear respuestas JSON de la API.
 * Implementa un formato consistente para respuestas exitosas y errores.
 */
trait ApiResponse
{
     /**
      * Genera una respuesta JSON exitosa
      *
      * @param mixed|null $data Datos a incluir en la respuesta
      * @param string $message Mensaje descriptivo de la operación
      * @param int $code Código de estado HTTP
      * @return \Illuminate\Http\JsonResponse
      */
     protected function success($data = null, $message = 'Operación exitosa', $code = 200)
     {
          return response()->json([
               'ok' => true,
               'status' => 'success',
               'code' => $code,
               'message' => $message,
               'data' => $data
          ], $code);
     }

     /**
      * Genera una respuesta JSON de error
      *
      * @param string $message Mensaje descriptivo del error
      * @param int $code Código de estado HTTP
      * @param mixed|null $errors Detalles adicionales del error
      * @return \Illuminate\Http\JsonResponse
      */
     protected function error($message = 'Ocurrió un error', $code = 400, $errors = null)
     {
          return response()->json([
               'ok' => false,
               'status' => 'error',
               'code' => $code,
               'message' => $message,
               'errors' => $errors
          ], $code);
     }
}
