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
    Log::info('Entrando a showText:', [
        'user_id' => auth()->id(),
        'category' => $category,
        'filename' => $filename,
    ]);

    $user = auth()->user();
    $experimentation = \App\Models\Experimentation::where('user_id', $user->id)->first();

    if (!$experimentation) {
        Log::error('No se encontró información de experimentación.', ['user_id' => $user->id]);
        abort(403, 'No se encontró información de experimentación.');
    }

    $typeText = $experimentation->type_text;
    Log::info('Tipo de texto seleccionado:', ['type_text' => $typeText]);

    $folder = $typeText == 1 ? 'humoristic' : 'original';
    $path = public_path("texts/$folder/$category/$filename.txt");

    if (!File::exists($path)) {
        Log::error("Archivo no encontrado", ['path' => $path]);
        abort(404, "No se encontró el texto solicitado.");
    }

    $content = File::get($path);
    Log::info('Texto encontrado y cargado.', ['path' => $path]);

    return view('show_text', compact('content', 'filename'));
}




}
