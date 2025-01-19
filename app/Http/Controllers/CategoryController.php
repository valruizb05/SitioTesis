<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Experimentation;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category'); // Vista de categorías
    }
    

    public function listTexts($category)
{
    $categories = [
        'biologia' => 1,
        'geografia' => 2,
        'historia' => 3,
    ];

    $id_categoria = $categories[$category] ?? null;

    if (!$id_categoria) {
        return redirect()->back()->withErrors('Categoría no válida.');
    }

    if (!auth()->check()) {
        return redirect()->route('login')->withErrors('Por favor, inicia sesión para continuar.');
    }

    Experimentation::updateOrCreate(
        ['user_id' => auth()->id()],
        ['asignature_id' => $id_categoria]
    );

    // Simulación: Cambia esto por la lógica para obtener textos reales
    $texts = [
        ['id' => 1, 'name' => 'Texto 1'],
        ['id' => 2, 'name' => 'Texto 2'],
        ['id' => 3, 'name' => 'Texto 3'],
    ];

    return view('list', compact('texts', 'category'));
}


 }