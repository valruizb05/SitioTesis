<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si es diferente al predeterminado (plural del modelo)
    protected $table = 'user';

    // Opcional: define los campos asignables masivamente
    protected $fillable = [
        'name', 'lastname', 'age', 'gender', 'education'
    ];

    // Si la tabla no tiene timestamps (created_at, updated_at)
    public $timestamps = false;
}
