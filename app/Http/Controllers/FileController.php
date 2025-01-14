<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    // Función para subir archivos
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt|max:2048', // Acepta solo archivos .txt
        ]);

        try {
            $file = $request->file('file');
            $path = $file->store('uploads'); // Guarda en storage/app/uploads
            Log::info('Archivo .txt subido: ' . $path);

            // Redirige a la vista para mostrar el contenido del archivo
            return response()->json([
                'success' => true,
                'message' => 'Archivo subido correctamente',
                'redirect_url' => route('show_uploaded_text', ['path' => $path]),
            ]);
        } catch (\Exception $e) {
            Log::error('Error al subir archivo .txt: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'No se pudo subir el archivo.'], 500);
        }
    }

    // Función para mostrar el contenido de archivos
    public function show(Request $request)
    {
        $path = $request->query('path');
        Log::info('Path recibido para archivo .txt: ' . $path);

        if (!Storage::exists($path)) {
            Log::error('Archivo no encontrado: ' . $path);
            return response()->json(['success' => false, 'error' => 'Archivo no encontrado.'], 404);
        }

        try {
            $content = Storage::get($path); // Lee el contenido del archivo .txt
            Log::info('Contenido del archivo .txt: ' . $content);

            return view('original_text', ['content' => $content]);
        } catch (\Exception $e) {
            Log::error('Error al procesar el archivo .txt: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'No se pudo procesar el archivo.'], 500);
        }
    }
}
