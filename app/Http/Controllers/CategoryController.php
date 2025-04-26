<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();  // O puedes usar paginate() para paginación
        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
     public function create()
     {
         return Inertia::render('Categories/Create');
     }
 
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
         ]);
 
         Category::create($request->only('name', 'description'));
 
         return redirect()->route('categories.index')->with('success', 'Categoría creada');
     }
 
     public function edit(Category $category)
     {
        return Inertia::render('Categories/Edit', [
            'category' => $category,  // Asegúrate de pasar el modelo completo
        ]);
     }
 
     public function update(Request $request, Category $category)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
         ]);
 
         $category->update($request->only('name', 'description'));
 
         return redirect()->route('categories.index')->with('success', 'Categoría actualizada');
     }
 
     public function destroy(Category $category)
     {
         $category->delete();
         return redirect()->route('categories.index')->with('success', 'Categoría eliminada');
     }
}
