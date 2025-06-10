<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     use ApiResponse;

     /**
      * Obtiene la lista de categorías
      * 
      * @return \Illuminate\Http\JsonResponse
      */
     public function index()
     {
          $categories = Category::all();
          return $this->success($categories, 'Categorías obtenidas correctamente');
     }

     /**
      * Crea una nueva categoría
      * 
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\Http\JsonResponse
      */
     public function store(Request $request)
     {
          $request->validate([
               'name' => 'required|string|max:255',
          ]);

          $category = Category::create($request->all());
          return $this->success($category, 'Categoría creada correctamente');
     }

     /**
      * Obtiene una categoría específica
      * 
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */
     public function show($id)
     {
          $category = Category::find($id);
          if (!$category) {
               return $this->error('Categoría no encontrada', 404);
          }
          return $this->success($category, 'Categoría obtenida correctamente');
     }
     
     /**
      * Actualiza una categoría existente
      * 
      * @param \Illuminate\Http\Request $request
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */
     public function update(Request $request, $id)
     {
          $request->validate([
               'name' => 'required|string|max:255',
          ]);
          $category = Category::find($id);
          if (!$category) {
               return $this->error('Categoría no encontrada', 404);
          }
          $category->update($request->all());
          return $this->success($category, 'Categoría actualizada correctamente');
     }

     /**
      * Elimina una categoría existente
      * 
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */
     public function destroy($id)
     {
          $category = Category::find($id);
          if (!$category) {
               return $this->error('Categoría no encontrada', 404);
          }
          $category->delete();
          return $this->success(null, 'Categoría eliminada correctamente');
     }
}
