<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'movimentacoes';

    protected $fillable = [
        'sobremesa_id',
        'usuario_id',
        'data_hora',
        'tipo',
        'quantidade',
        'observacoes',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
        'quantidade' => 'integer',
    ];

    public function sobremesa(): BelongsTo
    {
        return $this->belongsTo(Sobremesa::class, 'sobremesa_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Scopes
    public function scopeEntradas($query)
    {
        return $query->where('tipo', 'entrada');
    }

    public function scopeSaidas($query)
    {
        return $query->where('tipo', 'saida');
    }
}
