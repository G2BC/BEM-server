<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FungiOccurrence
 * 
 * @property int $id
 * @property int $fungi_id
 * @property int $occurrence_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class FungiOccurrence extends Pivot
{
	use SoftDeletes;
	protected $table = 'fungi_occurrence';

	protected $casts = [
		'fungi_id' => 'int',
		'occurrence_id' => 'int'
	];

	protected $fillable = [
		'fungi_id',
		'occurrence_id'
	];
}
