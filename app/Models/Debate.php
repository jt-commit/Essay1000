<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debate extends Model
{
    protected $table = 'debate';
    protected $primaryKey = 'DEB_CODIGO';
    public $timestamps = false;

    protected $fillable = ['DEB_RED_CODIGO', 'DEB_AUTOR', 'DEB_MENSAGEM', 'DEB_RESULTADO'];

    public function redacao()
    {
        return $this->belongsTo(Redacao::class, 'DEB_RED_CODIGO', 'RED_CODIGO');
    }
}