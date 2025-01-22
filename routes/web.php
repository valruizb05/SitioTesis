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
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ExperimentationController;
use Illuminate\Support\Facades\Auth;


#REGISTRO
Route::post('/submit_users', [UserController::class, 'store'])->name('submit_users');
Route::get('/personal-data', [UserController::class, 'showPersonalDataForm'])->name('personal_data');

#ASIGNATURA
Route::get('/category', [CategoryController::class, 'index'])->name('category');

#TIPO DE TEXTO
Route::post('/saveTypeText', [ExperimentationController::class, 'saveTypeText'])->name('saveTypeText');

#LISTAR TEXTOS
Route::get('/list-texts/{category}', [CategoryController::class, 'listTexts'])->name('listTexts');

#GUARDAR LA CATEGORIA SELECCIONADA 
Route::post('/save-category', [CategoryController::class, 'saveCategory'])->name('saveCategory');

Route::get('/text/{category}/{filename}', [TextController::class, 'showText'])->name('showText');




#Route::get('/text/{type}', [TextController::class, 'show'])->name('text');

#Route::post('/upload_file', [FileController::class, 'upload'])->name('uploadFile');


Route::post('/quiz/{filename}', [QuizController::class, 'submitQuiz'])->name('submitQuiz');
Route::get('/evaluation', [QuizController::class, 'showEvaluation'])->name('evaluation');
Route::get('/evaluation/{type}/{filename}', [QuizController::class, 'showEvaluation'])->name('evaluation.show');
Route::get('/quiz/{filename}', [QuizController::class, 'showQuiz'])->name('quiz.show');
Route::get('/showText/{type}/{filename}', [QuizController::class, 'showEvaluation'])->name('evaluation.show');










Route::get('/test', function () {
    return Storage::allFiles();
});

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


Route::match(['GET', 'POST'], '/', function () {
    if (request()->isMethod('POST')) {
        return 'Formulario enviado';
    }
    return view('index'); // Asegúrate de tener un archivo `resources/views/index.blade.php`
})->name('formulario');




















