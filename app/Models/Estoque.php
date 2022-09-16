<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    //TABELA QUE A MODEL FAZ REFERENCIA
    protected $table = 'estoque';

    //INPUTS
    protected $fillable = ['nome', 'tipo', 'descricao', 'quantidade', 'valor', 'valorvenda', 'data', 'datainicio', 'datafim'];

    //DESABILITA O UPDATE_AT e CREATE_AT
    public $timestamps = false;

    //SCOPE PARA ORDENAR LISTAGEM
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('id', 'desc');
        });
    }
}
