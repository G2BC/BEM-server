<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fungus
 * 
 * @property int $id
 * @property uuid $uuid
 * @property int|null $inaturalist_taxa
 * @property int $bem
 * @property string $kingdom
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $specie
 * @property string $scientific_name
 * @property string|null $popular_name
 * @property int|null $threatened
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Fungus extends Model
{
	use SoftDeletes;
	protected $table = 'fungi';

	protected $casts = [
		'uuid' => 'uuid',
		'inaturalist_taxa' => 'int',
		'bem' => 'int',
		'threatened' => 'int'
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
		'popular_name',
		'threatened',
		'description'
	];

	protected $guarded = ['id'];

	public function occurrences() 
	{
		return $this->belongsToMany('occurrence')->using('fungi_occurrence');
	}
}
