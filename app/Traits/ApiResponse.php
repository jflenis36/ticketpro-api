<?php

namespace App\Traits;

trait ApiResponse
{
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
