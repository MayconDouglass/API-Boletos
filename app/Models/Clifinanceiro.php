<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clifinanceiro
 * 
 * @property int $id
 * @property int $cliente
 * @property int $empresa
 * 
 *
 * @package App\Models
 */
class Clifinanceiro extends Model
{
	protected $table = 'clifinanceiro';
	public $timestamps = false;

	protected $casts = [
		'cliente' => 'int',
		'empresa' => 'int'
	];

	protected $fillable = [
		'cliente',
		'empresa'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cliente');
	}

	public function empresa()
	{
		return $this->belongsTo(Empresa::class, 'empresa');
	}
}
