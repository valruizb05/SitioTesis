<?php

use Illuminate\Support\Facades\Route;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::get('/related', function () {
    return view('related'); // Asegúrate de que `related.blade.php` exista
})->name('related');

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

// Ruta para la selección de categorías
Route::get('/ask_topic', function () {
    return view('ask_topic'); // Devuelve la vista `ask_topic.blade.php`
})->name('ask_topic');

// Ruta para manejar un formulario enviado desde el index
Route::post('/', function () {
    return 'Formulario enviado'; // Pendiente de implementación
})->name('formulario');

// Ruta para manejar la categoría seleccionada
Route::post('/ask-topic', function () {
    return 'Categoría seleccionada'; // Pendiente de implementación
})->name('ask_topic');

Route::post('/submit-personal-data', function (Request $request) {
    // Validación de los datos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|string|in:masculino,femenino',
        'education' => 'required|string',
    ]);

    // Guardar los datos en la base de datos
    \App\Models\PersonalData::create($validated);

    // Redirigir con un mensaje de éxito
    Alert::success('¡Éxito!', 'Registrado correctamente.');
    return redirect()->back()->with('success', 'Datos registrados correctamente.');
})->name('submit_personal_data');


