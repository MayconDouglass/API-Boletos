<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 * 
 * @property int $id_contrato
 * @property int $emp_cod
 * @property int $cli_cod
 * @property string $numero
 * @property string|null $path
 * @property int $ativo
 * @property Carbon $data_cad
 * @property Carbon|null $data_alt
 * 
 * @property Cliente $cliente
 * @property Empresa $empresa
 *
 * @package App\Models
 */
class Contrato extends Model
{
	protected $table = 'contrato';
	protected $primaryKey = 'id_contrato';
	public $timestamps = false;

	protected $casts = [
		'emp_cod' => 'int',
		'cli_cod' => 'int',
		'ativo' => 'int'
	];

	protected $dates = [
		'data_cad',
		'data_alt'
	];

	protected $fillable = [
		'emp_cod',
		'cli_cod',
		'numero',
		'path',
		'ativo',
		'data_cad',
		'data_alt'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cli_cod');
	}

	public function empresa()
	{
		return $this->belongsTo(Empresa::class, 'emp_cod');
	}
}
