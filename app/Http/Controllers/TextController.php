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
    $path = "texts/{$category}/{$filename}.txt";
    if (Storage::exists($path)) {
        $content = Storage::get($path);
        return view('text', ['content' => $content]);
    } else {
        abort(404, "El texto solicitado no existe.");
    }
}

public function listTextsByCategory($category)
{
    $path = storage_path("app/texts/{$category}");
    if (is_dir($path)) {
        $files = array_diff(scandir($path), ['..', '.']); // Lista de archivos
        return view('list-texts', ['files' => $files, 'category' => $category]);
    } else {
        abort(404, "La categoría solicitada no existe.");
    }
}

}
