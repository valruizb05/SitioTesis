<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experimentation extends Model
{
    use HasFactory;

    protected $table = 'experimentation'; // Nombre de la tabla

    protected $fillable = [
        'user_id',
        'asignature_id',
        'type_text',
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'humoristic',
        'compression',
        'preference',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}
