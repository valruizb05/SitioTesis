<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Experimentation;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category'); // Vista de categorías
    }

    public function listTextsByCategory($category)
    {
        // Verifica si el usuario está autenticado
        if (!auth()->check()) {
            abort(403, 'Usuario no autenticado.');
        }

        // Obtiene el tipo de texto seleccionado del usuario
        $userTypeText = Experimentation::where('user_id', auth()->id())->value('type_text');

        if (!$userTypeText) {
            return redirect()->route('category')->withErrors('No se encontró el tipo de texto seleccionado para este usuario.');
        }

        $folder = $userTypeText == 1 ? 'humoristic' : 'original';

        // Define la ruta completa
        $path = "texts/$folder/$category";

        // Verifica si la carpeta existe
        if (!Storage::exists($path)) {
            abort(404, "No se encontró la carpeta de textos para esta categoría: $path");
        }

        // Obtiene los textos disponibles en la carpeta
        $texts = Storage::files($path);

        // Verifica si hay textos disponibles
        if (empty($texts)) {
            return view('texts', [
                'texts' => [],
                'category' => $category,
                'error' => 'No hay textos disponibles en esta categoría.',
            ]);
        }

        // Retorna la vista con los textos
        return view('texts', compact('texts', 'category'));
    }
}

