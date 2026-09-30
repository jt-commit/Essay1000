<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroCorrecao extends Model
{
    protected $table = 'erro_correcao';
    protected $primaryKey = 'ERC_CODIGO';
    public $timestamps = false;

    protected $fillable = [
        'ERC_COR_CODIGO', 'ERC_DESCRICAO', 'ERC_DESCONTO',
        'ERC_CONTESTADO', 'ERC_ACEITO'
    ];

    public function correcao()
    {
        return $this->belongsTo(Correcao::class, 'ERC_COR_CODIGO', 'COR_CODIGO');
    }
}