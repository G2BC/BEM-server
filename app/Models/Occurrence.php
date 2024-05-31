<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Utils\Enums\OccurrenceTypes;
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
 * @property OccurrenceTypes $type
 * @property string $state_acronym
 * @property string $state_name
 * @property string $biome
 * @property string $literature_reference
 * @property float|null $latitude
 * @property float|null $longitude
 * @property bool $curation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @package App\Models
 */
class Occurrence extends Model
{
	use SoftDeletes;
	protected $table = 'occurrence';

	protected $casts = [
		'uuid' => 'string',
		'inaturalist_taxa' => 'int',
		'specieslink_id' => 'int',
		'type' => OccurrenceTypes::class,
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
		'habitat',
		'literature_reference',
		'latitude',
		'longitude',
		'curation'
	];

	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	public function fungis()
	{
		return $this->belongsToMany(Fungi::class)->using(FungiOccurrence::class);
	}
}
