<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\Results;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;
use Spatie\PdfToText\Pdf;


// Ruta principal
Route::get('/', function () {
    return view('index'); // Asegúrate de que `index.blade.php` exista
})->name('index');

// Ruta "About"
Route::get('/about', function () {
    return view('about'); // Asegúrate de que `about.blade.php` exista
})->name('about');

// Otras rutas
Route::get('/developers', function () {
    return view('developers'); // Asegúrate de que `developers.blade.php` exista
})->name('developers');

Route::get('/history', function () {
    return view('history'); // Asegúrate de que `history.blade.php` exista
})->name('history');

// Ruta para "Related Topics"
Route::get('/related', function () {
    return view('related'); // Devuelve la vista `related.blade.php`
})->name('related');

Route::get('/personal-data', function () {
    return view('personal_data'); // Asegúrate de que este archivo está en resources/views/
})->name('personal_data');

// Ruta para mostrar texto humorístico
Route::get('/humor_text', function () {
    $humor_text = "¿Por qué el libro de matemáticas estaba triste? ¡Porque tenía demasiados problemas!";
    return view('humor_text', compact('humor_text')); // Devuelve la vista `humor_text.blade.php`
})->name('humor_text');

// Ruta para el cuestionario de texto humorístico
Route::get('/humor_test', function () {
    return 'Aquí irá el cuestionario de la versión humorística.'; // Pendiente de implementación
})->name('humor_test');

Route::post('/upload_file', [FileController::class, 'upload'])->name('upload_file');
Route::get('/show_uploaded_text', [FileController::class, 'show'])->name('show_uploaded_text');

Route::get('/test', function () {
    return Storage::allFiles();
});

// Ruta para mostrar textos dentro de una categoría
Route::get('/categories/{category}', function ($category) {
    $texts = [
        'tema1.txt',
        'tema2.txt',
        'tema3.txt',
        'tema4.txt',
        'tema5.txt'
    ];
    return view('category_texts', compact('category', 'texts')); // Devuelve la vista `category_texts.blade.php`
})->name('category_texts');

// Ruta para mostrar un texto específico
Route::post('/show_texts', function () {
    return 'Texto seleccionado.'; // Pendiente de implementación
})->name('show_texts');

// Ruta para manejar un formulario enviado desde el index
Route::post('/', function () {
    return 'Formulario enviado'; // Pendiente de implementación
})->name('formulario');

Route::get('/ask-topic', function () {
    return view('ask_topic'); // Cambia 'ask_topic' por el nombre de tu vista correspondiente
})->name('ask_topic');


Route::post('/ask-topic', function (Request $request) {
    $validated = $request->validate([
        'category' => 'required|string',
    ]);

    session(['selected_category' => $validated['category']]);

    return response()->json([
        'success' => true,
        'message' => 'Categoría seleccionada correctamente.',
        'category_id' => $validated['category'],
    ]);
})->name('ask_topic');






Route::post('/submit_users', function (Request $request) {
    // Validación de los datos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|string|in:masculino,femenino',
        'education' => 'required|string',
    ]);

    // Guardar los datos en la base de datos
    \App\Models\User::create($validated);

    // Agrega el mensaje de éxito en la sesión
    Session::flash('success', 'Datos registrados correctamente.');

    // Devuelve la vista o redirección para que el JavaScript maneje el resto
    return redirect()->back();
})->name('submit_users');



#SELECCION DE MATERIA
Route::post('/select_asignature', function (Request $request) {
    $validated = $request->validate([
        'user_id' => 'required|integer|exists:users,id',
        'asignature_id' => 'required|integer|exists:asignatures,id',
    ]);

    Results::create([
        'user_id' => $validated['user_id'],
        'asignature_id' => $validated['asignature_id'],
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Materia seleccionada. Ahora carga tu archivo.',
        'asignature_id' => $validated['asignature_id'],
    ]);
})->name('select_asignature');










