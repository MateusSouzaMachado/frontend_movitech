<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimentacaoEstoque extends Model
{

    use HasFactory;

    protected $table = 'movimentacao_estoque'; // Importante se o nome for diferente do padrão

    protected $fillable = [
        'estoque_id',
        'responsavel_id',
        'tipo',
        'quantidade',
        'motivo',
    ];

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Administrador::class, 'responsavel_id');
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class);
    }
}
