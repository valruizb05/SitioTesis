<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Especificar el nombre de la tabla si es diferente al predeterminado (plural del modelo)
    protected $table = 'user';

    // Define los campos asignables masivamente
    protected $fillable = [
        'name',
        'lastname',
        'age',
        'gender',
        'education',
    ];

    // Si la tabla no tiene timestamps (created_at, updated_at)
    public $timestamps = false;

    // Relación con el modelo Experimentation
    public function experimentations()
    {
        return $this->hasMany(Experimentation::class);
    }
}
