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
        // Obtiene el tipo de texto seleccionado del usuario
        $userTypeText = Experimentation::where('user_id', auth()->id())->value('type_text');
        $folder = $userTypeText == 1 ? 'humoristic' : 'original';

        // Construye la ruta de la categoría seleccionada
        $path = "texts/$folder/$category";

        // Obtiene los textos disponibles en la carpeta
        $texts = Storage::files($path);

        return view('texts', compact('texts', 'category'));
    }
}

