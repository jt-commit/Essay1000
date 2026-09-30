<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correcao extends Model
{
    protected $table = 'correcao';
    protected $primaryKey = 'COR_CODIGO';
    public $timestamps = false;

    protected $fillable = ['COR_RED_CODIGO', 'COR_NOTA', 'COR_TEXTO', 'COR_FOLHA'];

    public function getRouteKeyName()
    {
        return 'COR_CODIGO';
    }

    public function redacao()
    {
        return $this->belongsTo(Redacao::class, 'COR_RED_CODIGO', 'RED_CODIGO');
    }

    public function erros()
    {
        return $this->hasMany(ErroCorrecao::class, 'ERC_COR_CODIGO', 'COR_CODIGO');
    }
}