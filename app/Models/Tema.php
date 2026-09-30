<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'tema';
    protected $primaryKey = 'TEM_CODIGO';
    public $timestamps = false;

    protected $fillable = ['TEM_NOME', 'TEM_ATIVO'];

    public function getRouteKeyName()
    {
        return 'TEM_CODIGO';
    }

    public function usuarios()
    {
        return $this->hasMany(User::class, 'USU_TEM_CODIGO', 'TEM_CODIGO');
    }
}
