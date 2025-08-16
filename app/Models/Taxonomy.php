<?php

namespace App\Models;

use App\Enum\FungiTaxon\TaxonType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Taxonomy extends Model
{
    use HasFactory;

    protected $attribute = [
        'type' => TaxonType::MAIN
    ];

    protected $fillable = [
        'external_id',
        'platform',
        'kingdom',
        'phylum',
        'class',
        'order',
        'family',
        'genus',
        'specie',
        'authors',
        'type',
        'fungi_id',
        'scientific_name',
    ];

    public function fungi(): BelongsTo
    {
        return $this->BelongsTo(Fungi::class);
    }
}
