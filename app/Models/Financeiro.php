<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Financeiro
 * 
 * @property int $id_doc
 * @property int $emp_cod
 * @property int $cli_cod
 * @property string $descricao
 * @property string $numero_doc
 * @property string $serie
 * @property int $parcela
 * @property int $tipo_titulo
 * @property Carbon $dt_vencimento
 * @property Carbon|null $dt_pagamento
 * @property Carbon $dt_emissao
 * @property float $valor
 * @property float $multa_juros
 * @property int $status
 * @property float $valor_original
 * @property string $linha_digitavel
 * 
 * @property Empresa $empresa
 * @property Cliente $cliente
 * @property Collection|Clifinanceiro[] $clifinanceiros
 *
 * @package App\Models
 */
class Financeiro extends Model
{
	protected $table = 'financeiro';
	protected $primaryKey = 'id_doc';
	public $timestamps = false;

	protected $casts = [
		'emp_cod' => 'int',
		'cli_cod' => 'int',
		'parcela' => 'int',
		'tipo_titulo' => 'int',
		'valor' => 'float',
		'multa_juros' => 'float',
		'status' => 'int',
		'valor_original' => 'float'
	];

	protected $dates = [
		'dt_vencimento',
		'dt_pagamento',
		'dt_emissao'
	];

	protected $fillable = [
		'emp_cod',
		'cli_cod',
		'descricao',
		'numero_doc',
		'serie',
		'parcela',
		'tipo_titulo',
		'dt_vencimento',
		'dt_pagamento',
		'dt_emissao',
		'valor',
		'multa_juros',
		'status',
		'valor_original',
		'linha_digitavel'
	];

	public function empresa()
	{
		return $this->belongsTo(Empresa::class, 'emp_cod');
	}

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cli_cod');
	}

	public function clifinanceiros()
	{
		return $this->hasMany(Clifinanceiro::class, 'financeiro');
	}
}
