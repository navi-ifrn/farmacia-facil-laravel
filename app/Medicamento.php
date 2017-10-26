<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{

    const TIPO_CAPSULA = 1;
    const TIPO_GOTAS = 2;

    const TIPOS = [
        self::TIPO_CAPSULA => 'Capsulas',
        self::TIPO_GOTAS => 'Gotas'
    ];

    protected $fillable = ['nome', 'bula', 'valor_compra', 'porcentagem_lucro', 'tipo', 'estoque', 'laboratorio_id'];

    public function getValorVendaAttribute()
    {
        return $this->valor_compra + ($this->valor_compra * ($this->porcentagem_lucro / 100));
    }

    public function getValorVendaFormatadoAttribute()
    {
        return 'R$' . number_format($this->valor_venda, 2, ',', '.');
    }

    public function getTipoComoTextoAttribute()
    {
        return self::TIPOS[$this->tipo];
    }

    public function getTemNoEstoqueAttribute()
    {
        return $this->estoque > 0;
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }
}
