<?php

use Illuminate\Support\Facades\Route;
use App\Models\Results;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExperimentationController;

#RUTA DESPUES DE REGISTRAR SELECCIONAR TIPO TEXTO 

Route::get('/text/{type}', [TextController::class, 'show'])->name('text');
Route::post('/save-type-text', [ExperimentationController::class, 'saveTypeText'])->name('saveTypeText');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/save-category', [CategoryController::class, 'saveCategory'])->name('saveCategory');
Route::post('/upload_file', [FileController::class, 'upload'])->name('uploadFile');
Route::post('/submit_users', [UserController::class, 'store'])->name('submit_users');
Route::get('/text/{category}/{filename}', [TextController::class, 'showText'])->name('showText');
Route::get('/personal-data', [UserController::class, 'showPersonalDataForm'])->name('personal_data');
Route::get('/texts/{category}', [CategoryController::class, 'listTextsByCategory'])->name('listTexts');
Route::get('/quiz/{filename}', [QuizController::class, 'showQuiz'])->name('showQuiz');
Route::post('/quiz/{filename}', [QuizController::class, 'submitQuiz'])->name('submitQuiz');


// Ruta para mostrar el contenido de un texto específico
Route::post('/show_texts', function (Request $request) {
    $textPath = $request->input('text'); // Obtén el texto seleccionado
    $content = Storage::get($textPath); // Obtén el contenido del texto

    return view('show_text', compact('content'));
})->name('show_texts');




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


Route::post('/upload_file', [FileController::class, 'upload'])->name('upload_file');
Route::get('/show_uploaded_text', [FileController::class, 'show'])->name('show_uploaded_text');

Route::get('/test', function () {
    return Storage::allFiles();
});




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
















