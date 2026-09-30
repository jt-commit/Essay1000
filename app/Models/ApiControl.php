<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiControl extends Model
{
    protected $table = 'api_control';
    public $timestamps = false;

    protected $fillable = ['indice_atual'];
}
