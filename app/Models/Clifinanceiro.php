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
 * @property int $financeiro
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
		'financeiro' => 'int'
	];

	protected $fillable = [
		'cliente',
		'financeiro'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cliente');
	}

	public function financeiro()
	{
		return $this->belongsTo(Financeiro::class, 'financeiro');
	}
}
