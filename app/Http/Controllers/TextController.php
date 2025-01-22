<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TextController extends Controller
{
    public function showText($category, $filename)
    {
        // Determina el tipo de texto (humorístico u original)
        $folder = auth()->user()->type_text == 1 ? 'humoristic' : 'original';
    
        // Construye la ruta al archivo
        $path = public_path("texts/$folder/$category/$filename.txt");
    
        // Verifica si el archivo existe
        if (!File::exists($path)) {
            Log::error("Archivo no encontrado", ['path' => $path]);
            abort(404, "No se encontró el texto solicitado: $filename.");
        }
    
        // Obtén el contenido del archivo
        $content = File::get($path);
        Log::info('Mostrando texto:', ['category' => $category, 'filename' => $filename, 'path' => $path]);

        // Devuelve la vista con el contenido del texto
        return view('show_text', compact('content', 'filename'));
    }


}
