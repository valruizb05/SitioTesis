<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToText\Pdf;

class FileController extends Controller
{
    // Función para subir archivos
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:txt,pdf|max:2048',
    ]);

    try {
        $file = $request->file('file');
        $path = $file->store('uploads');
        Log::info('Archivo subido: ' . $path);

        // Redirección a la vista que muestra el contenido del archivo
        return response()->json([
            'success' => true,
            'message' => 'Archivo subido correctamente',
            'redirect_url' => route('show_uploaded_text', ['path' => $path]),
        ]);
    } catch (\Exception $e) {
        Log::error('Error al subir archivo: ' . $e->getMessage());
        return response()->json(['success' => false, 'error' => 'No se pudo subir el archivo.'], 500);
    }
}

    // Función para mostrar el contenido de archivos
    public function show(Request $request)
{
    $path = $request->query('path');
    Log::info('Path recibido: ' . $path);

    if (!Storage::exists($path)) {
        Log::error('Archivo no encontrado: ' . $path);
        return response()->json(['success' => false, 'error' => 'Archivo no encontrado.'], 404);
    }

    $filePath = storage_path('app/' . $path);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    Log::info('Extensión del archivo: ' . $extension);

    try {
        if ($extension === 'txt') {
            $content = Storage::get($path);
            Log::info('Contenido del archivo TXT: ' . $content);
        } elseif ($extension === 'pdf') {
            $content = Pdf::getText($filePath, env('PDFTOTEXT_PATH'));
            Log::info('Contenido del archivo PDF: ' . $content);
        } else {
            Log::warning('Tipo de archivo no soportado: ' . $extension);
            return response()->json(['success' => false, 'error' => 'Tipo de archivo no soportado.'], 400);
        }

        return view('original_text', ['content' => $content]);
    } catch (\Exception $e) {
        Log::error('Error al procesar el archivo: ' . $e->getMessage());
        return response()->json(['success' => false, 'error' => 'No se pudo procesar el archivo.'], 500);
    }
}

}
