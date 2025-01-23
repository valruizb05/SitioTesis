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

public function showEvaluation($type, $category, $filename)
{
    // Define las rutas completas basadas en la categoría y tipo de texto
    $originalPath = public_path("texts/original/{$category}/{$filename}.txt");
    $humorPath = public_path("texts/humoristic/{$category}/{$filename}.txt");

    Log::info("Ruta completa del archivo original: {$originalPath}");
    Log::info("Ruta completa del archivo humorístico: {$humorPath}");

    // Verifica si el archivo existe
    if ($type === 'original' && File::exists($originalPath)) {
        $content = File::get($originalPath);
    } elseif ($type === 'humor' && File::exists($humorPath)) {
        $content = File::get($humorPath);
    } else {
        Log::error("Archivo no encontrado para tipo: {$type}, categoría: {$category}, archivo: {$filename}");
        abort(404, "El texto solicitado no está disponible.");
    }

    Log::info("El tipo de texto es: {$type}, categoría: {$category}");
Log::info("Archivo a cargar: {$filename}");


    // Retorna la vista con el contenido del texto
    return view('evaluation', [
        'nextTextType' => $type,
        'content' => $content,
        'filename' => $filename,
        'category' => $category,
    ]);
}



}

