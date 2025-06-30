<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
class User extends Authenticatable
{    use HasApiTokens, Notifiable;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // optionnel selon ce que tu veux insérer
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
