<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscalLog extends Model
{
    use HasFactory;
    protected $table = 'notas_fiscais_logs';
    protected $fillable = [
        'cnpj',
        'descricao'
    ];
}
