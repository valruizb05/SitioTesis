<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experimentation;
use Illuminate\Support\Facades\Log;

class ExperimentationController extends Controller
{
    public function selectCategory(Request $request)
    {
        // Obtener el usuario actual (asume que tienes autenticación)
        $user = auth()->user();

        // Crear un nuevo registro en la tabla experimentation
        $experimentation = Experimentation::create([
            'user_id' => $user->id,
            'id_asignature' => $request->input('category_id'), // ID de la categoría seleccionada
        ]);

        // Retornar la vista para seleccionar tipo de texto
        return view('select_text_type', compact('experimentation'));
    }

    public function saveTypeText(Request $request)
{
    Log::info('Datos recibidos en saveTypeText:', $request->all());
    try {
        // Valida los datos enviados
        $validated = $request->validate([
            'type_text' => 'required|integer|in:1,2',
            'user_id' => 'required|integer|exists:user,id',
        ]);

        // Guarda o actualiza el tipo de texto en la tabla `experimentation`
        Experimentation::updateOrCreate(
            ['user_id' => $validated['user_id']],
            ['type_text' => $validated['type_text']]
        );

        return response()->json([
            'success' => true,
            'message' => 'Tipo de texto guardado correctamente.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar el tipo de texto: ' . $e->getMessage(),
        ], 500);
    }
}


    
}
