<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    protected $table = 'redacao';
    protected $primaryKey = 'RED_CODIGO';
    public $timestamps = false;

    protected $fillable = [
        'RED_TEMA', 'RED_INTRODUCAO', 'RED_DESENVOLVIMENTO',
        'RED_CONCLUSAO', 'RED_USU_CODIGO', 'RED_DEBATE_ENCERRADO'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'RED_USU_CODIGO', 'USU_CODIGO');
    }

    public function correcao()
    {
        return $this->hasOne(Correcao::class, 'COR_RED_CODIGO', 'RED_CODIGO');
    }

    public function debates()
    {
        return $this->hasMany(Debate::class, 'DEB_RED_CODIGO', 'RED_CODIGO');
    }

    public function getRouteKeyName()
    {
        return 'RED_CODIGO';
    }
}
