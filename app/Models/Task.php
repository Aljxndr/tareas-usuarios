<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    /**
     * Una tarea pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
