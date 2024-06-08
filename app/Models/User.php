<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Utils\Enums\UserTypes;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * 
 * @property int $id
 * @property uuid $uuid
 * @property UserTypes $type
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $institution
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class User extends Model implements JWTSubject
{
	use SoftDeletes;
	protected $table = 'user';

	protected $casts = [
		'uuid' => 'uuid',
		'type' => UserTypes::class
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'uuid',
		'type',
		'name',
		'email',
		'password',
		'institution'
	];

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}
}
