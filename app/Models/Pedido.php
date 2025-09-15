<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
      protected $fillable = [
        'mecanica_id', 'status', 'valor_total',
        'endereco_entrega', 'metodo_pagamento', 'numero_nota_fiscal'
    ];

      public function mecanica()
    {
        return $this->belongsTo(Mecanica::class);
    }

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
