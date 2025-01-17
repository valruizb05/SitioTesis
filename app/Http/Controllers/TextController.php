<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TextController extends Controller
{
    public function show($type)
    {
        if ($type === 'humoristic') {
            $text = "Este es un texto humorístico.";
        } else {
            $text = "Este es un texto original sin humor.";
        }

        return view('text', compact('text'));
    }

    

    public function showText($category, $filename)
    {
        // Define la ruta del archivo basado en la categoría y el nombre del archivo
        $folder = auth()->user()->type_text == 1 ? 'humoristic' : 'original';
        $path = "texts/$folder/$category/$filename.txt";

        // Verifica si el archivo existe
        if (!Storage::exists($path)) {
            abort(404, "No se encontró el texto solicitado: $filename.");
        }

        // Lee el contenido del archivo
        $content = Storage::get($path);

        // Retorna una vista para mostrar el texto
        return view('show_text', compact('content', 'filename'));
    }


}
