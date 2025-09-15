<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mecanica extends Model
{
    protected $fillable = ['cnpj','razao_social','nome_fantasia','endereco','telefone','email','senha','aprovado'];
}
