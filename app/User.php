<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
