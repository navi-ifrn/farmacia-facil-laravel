<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['usuario_id', 'total'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class)->withPivot(['quantidade', 'valor_unitario']);
    }

    public function getTotalFormatadoAttribute()
    {
        return 'R$' . number_format($this->total, 2, ',', '.');
    }
}
