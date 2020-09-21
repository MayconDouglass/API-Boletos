<?php
namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User1 extends Authenticatable implements JWTSubject
{
    use Notifiable;

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

	public function boletos()
	{
		return $this->hasMany(Financeiro::class, 'cli_cod');
	}
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
	}
}