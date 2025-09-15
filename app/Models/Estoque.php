<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['produto_id', 'quantidade', 'quantidade_minima'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
    public function movimentacoes()
    {
        return $this->hasMany(MovimentacaoEstoque::class);
    }   
}
