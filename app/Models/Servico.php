<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    //TABELA QUE A MODEL FAZ REFERENCIA
    protected $table = 'servicos';

    //INPUTS
    protected $fillable = ['nomecliente', 'pagamento', 'servico', 'custo', 'valor', 'data', 'nomevendedor', 'unidade', 'datainicio', 'datafim'];

    //DESABILITA O UPDATE_AT e CREATE_AT
    public $timestamps = false;

    //FUNÇÃO PARA ORDENAR A LISTAGEM
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder){
            $queryBuilder->orderBy('id', 'desc');
        });
    }
}
