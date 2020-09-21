<?php
namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Empresa as Authenticatable;

class Empresa extends Authenticatable implements JWTSubject
{
    use Notifiable;

	
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

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'emp_cod',
		'razao_social',
		'emp_cgc',
		'emp_tel',
		'auth_rest',
		'password',
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