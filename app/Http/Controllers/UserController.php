<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Degree;

class UserController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:masculino,femenino',
            'education' => 'required|integer|exists:degree,id',
        ]);
    
        // Guarda el usuario
        $user = User::create($validated);
    
        // Autentica al usuario después de registrarlo
        auth()->login($user);
    
        // Retorna éxito
        return redirect()->back()->with('success', 'Datos registrados correctamente.');
    }

    public function show()
    {
        return view('personal-data'); // Asegúrate de que la vista exista.
    }
    


public function showPersonalDataForm()
{
    $degrees = Degree::all();

    // Asegúrate de que esto esté devolviendo una colección
    if ($degrees->isEmpty()) {
        // Manejo de error si no hay grados
        abort(404, 'No se encontraron grados.');
    }

    return view('personal_data', compact('degrees'));
}
}
