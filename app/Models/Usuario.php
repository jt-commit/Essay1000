<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'USU_CODIGO';
    public $timestamps = false;

    protected $fillable = [
        'USU_NOME', 'USU_SENHA', 'USU_EMAIL', 'USU_FONTE', 'USU_TEM_CODIGO'
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'USU_TEM_CODIGO', 'TEM_CODIGO');
    }
}
