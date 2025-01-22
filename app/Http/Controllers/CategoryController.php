<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Experimentation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $experimentation = Experimentation::where('user_id', $user->id)->first();

    // Verifica si el tipo de texto fue guardado correctamente
    Log::info('Tipo de texto del usuario:', [
        'user_id' => $user->id,
        'type_text' => $experimentation->type_text ?? 'No definido'
    ]);

    return view('category', ['type_text' => $experimentation->type_text ?? null]);
}
    

public function saveCategory(Request $request)
{
    // Validar que la categoría enviada exista en la base de datos
    $validated = $request->validate([
        'category' => 'required|integer|exists:asignature,id',
    ]);

    // Guardar la categoría en la tabla `experimentation`
    Experimentation::updateOrCreate(
        ['user_id' => Auth::id()],
        ['asignature_id' => $validated['category']] // Guarda el ID de la categoría seleccionada
    );

    Log::info('Categoría guardada:', ['category' => $validated['category']]);

    // Redirigir al método listTexts con el nombre de la categoría
    $categoryName = $this->getCategoryNameById($validated['category']);
    return redirect()->route('listTexts', ['category' => $categoryName]);
}

/**
 * Método auxiliar para obtener el nombre de la categoría por ID
 */
private function getCategoryNameById($categoryId)
{
    $categories = [
        1 => 'biologia',
        2 => 'geografia',
        3 => 'historia',
    ];

    return $categories[$categoryId] ?? 'unknown';
}



public function listTexts($category)
{
    Log::info('Entrando a listTexts:', ['category' => $category]);

    $user = auth()->user();

    // Recupera el registro de experimentación del usuario
    $experimentation = Experimentation::where('user_id', $user->id)->first();

    if (!$experimentation) {
        return redirect()->route('category')->withErrors('No se encontró el registro de experimentación.');
    }

    // Determina la carpeta según el tipo de texto
    $folder = $experimentation->type_text == 1 ? 'humoristic' : 'original';

    // Construye la ruta de la carpeta
    $path = public_path("texts/$folder/$category");

    if (!File::exists($path)) {
        return redirect()->route('category')->withErrors("No se encontraron textos para la categoría seleccionada.");
    }

    // Obtén los archivos dentro de la carpeta
    $files = File::files($path);
    Log::info('Archivos encontrados:', ['files' => $files]);

    // Devuelve la vista con los textos
    return view('list', compact('files', 'category'));
}




 }