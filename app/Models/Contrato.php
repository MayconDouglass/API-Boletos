<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 * 
 * @property int $id_contrato
 * @property int $cli_cod
 * @property string $numero
 * @property int $ativo
 * 
 * @property Cliente $cliente
 *
 * @package App\Models
 */
class Contrato extends Model
{
	protected $table = 'contrato';
	protected $primaryKey = 'id_contrato';
	public $timestamps = false;

	protected $casts = [
		'cli_cod' => 'int',
		'ativo' => 'int'
	];

	protected $fillable = [
		'cli_cod',
		'numero',
		'ativo'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cli_cod');
	}
}
