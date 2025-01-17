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

public function submitQuiz(Request $request, $filename)
{
    $userAnswers = $request->input('answers');

    // Define los cuestionarios
    $quizzes = [
        'AparatoRespiratorio' => [
            ['correct' => 1],
            ['correct' => 1],
            ['correct' => 0],
            ['correct' => 0],
            ['correct' => 0],
        ],
        // Agrega otros cuestionarios aquí...
    ];

    $correctAnswers = $quizzes[$filename] ?? [];
    $results = [];

    // Verificar respuestas y calcular aciertos
    foreach ($correctAnswers as $index => $correctAnswer) {
        $results["question" . ($index + 1)] = (isset($userAnswers[$index]) && $userAnswers[$index] == $correctAnswer['correct']) ? 1 : 0;
    }

    // Buscar la fila correspondiente al usuario en `experimentation` y actualizar
    $experimentation = Experimentation::where('user_id', auth()->id())
                                       ->where('asignature_id', $this->getAsignatureId($filename))
                                       ->first();

    if ($experimentation) {
        $experimentation->update($results);
    } else {
        // Si no existe, crea una nueva fila
        Experimentation::create(array_merge([
            'user_id' => auth()->id(),
            'asignature_id' => $this->getAsignatureId($filename), // Función que obtiene el asignature_id según el texto
            'type_text' => 1, // Asigna el valor correspondiente
        ], $results));
    }

    // Redirigir con mensaje de éxito
    $score = array_sum($results);
    return redirect()->route('index')->with('success', "Obtuviste $score/" . count($correctAnswers) . " respuestas correctas.");
}



    
}

