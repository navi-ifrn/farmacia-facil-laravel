<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $fillable = ['nome'];

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }
}
