<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Utils\Enums\BemClassification;
use App\Utils\Enums\RedListClassification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fungi
 * 
 * @property int $id
 * @property uuid $uuid
 * @property int|null $inaturalist_taxa
 * @property BemClassification $bem
 * @property string $kingdom
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $specie
 * @property string $scientific_name
 * @property string|null $popular_name
 * @property string|null $authors
 * @property string|null $brazilian_type
 * @property string|null $brazilian_type_synonym
 * @property RedListClassification|null $threatened
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Fungi extends Model
{
	use SoftDeletes;
	protected $table = 'fungi';

	protected $casts = [
		'uuid' => 'string',
		'inaturalist_taxa' => 'int',
		'bem' => BemClassification::class,
		'threatened' => RedListClassification::class
	];

	protected $fillable = [
		'uuid',
		'inaturalist_taxa',
		'bem',
		'kingdom',
		'phylum',
		'class',
		'order',
		'family',
		'genus',
		'specie',
		'scientific_name',
		'authors',
		'brazilian_type',
		'brazilian_type_synonym',
		'popular_name',
		'threatened',
		'description'
	];

	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	public function occurrences()
	{
		return $this->belongsToMany(Occurrence::class)->using(FungiOccurrence::class);
	}
}
