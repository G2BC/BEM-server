<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Occurrence
 * 
 * @property int $id
 * @property uuid $uuid
 * @property int|null $inaturalist_taxa
 * @property int|null $specieslink_id
 * @property int $type
 * @property string $state_acronym
 * @property string $state_name
 * @property string $biome
 * @property string $literature_reference
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Occurrence extends Model
{
	use SoftDeletes;
	protected $table = 'occurrence';

	protected $casts = [
		'uuid' => 'uuid',
		'inaturalist_taxa' => 'int',
		'specieslink_id' => 'int',
		'type' => 'int',
		'latitude' => 'double',
		'longitude' => 'double'
	];

	protected $fillable = [
		'uuid',
		'inaturalist_taxa',
		'specieslink_id',
		'type',
		'state_acronym',
		'state_name',
		'biome',
		'literature_reference',
		'latitude',
		'longitude'
	];

	public function fungis() 
	{
		return $this->belongsToMany('fungi')->using('fungi_occurrence');
	}
}
