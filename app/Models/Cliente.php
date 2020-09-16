<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $id_cliente
 * @property string $nome
 * @property string $cgc
 * @property string $password
 * @property string|null $remember_token
 * @property int $ativo
 * @property int $status
 * 
 * @property Collection|Clifinanceiro[] $clifinanceiros
 * @property Collection|Contrato[] $contratos
 * @property Collection|Financeiro[] $financeiros
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'id_cliente';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nome',
		'cgc',
		'password',
		'remember_token',
		'ativo',
		'status'
	];

	public function clifinanceiros()
	{
		return $this->hasMany(Clifinanceiro::class, 'cliente');
	}

	public function contratos()
	{
		return $this->hasMany(Contrato::class, 'cli_cod');
	}

	public function financeiros()
	{
		return $this->hasMany(Financeiro::class, 'cli_cod');
	}
}
