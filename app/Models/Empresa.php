<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 * 
 * @property int $id_empresa
 * @property int $emp_cod
 * @property string $razao_social
 * @property string $emp_cgc
 * @property string $emp_tel
 * @property Carbon $data_cad
 * @property Carbon $data_alt
 * @property int $status
 * 
 * @property Collection|Cliempresa[] $cliempresas
 * @property Collection|Financeiro[] $financeiros
 *
 * @package App\Models
 */
class Empresa extends Model
{
	protected $table = 'empresas';
	protected $primaryKey = 'id_empresa';
	public $timestamps = false;

	protected $casts = [
		'emp_cod' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'data_cad',
		'data_alt'
	];

	protected $fillable = [
		'emp_cod',
		'razao_social',
		'emp_cgc',
		'emp_tel',
		'data_cad',
		'data_alt',
		'status'
	];

	public function cliempresas()
	{
		return $this->hasMany(Cliempresa::class, 'empresa');
	}

	public function financeiros()
	{
		return $this->hasMany(Financeiro::class, 'emp_cod');
	}
}
