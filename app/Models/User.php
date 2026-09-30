<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['USU_NOME', 'USU_SENHA', 'USU_EMAIL', 'USU_FONTE', 'USU_TEM_CODIGO'])]
#[Hidden(['USU_SENHA'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'USU_CODIGO';
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->USU_SENHA;
    }

    public function getRouteKeyName()
    {
        return 'USU_CODIGO';
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'USU_TEM_CODIGO', 'TEM_CODIGO');
    }

    public function redacoes()
    {
        return $this->hasMany(Redacao::class, 'RED_USU_CODIGO', 'USU_CODIGO');
    }
}