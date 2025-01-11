<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;

    protected $table = 'personal_data'; // Nombre de la tabla
    protected $fillable = ['name', 'surname', 'age', 'gender', 'education'];
}
