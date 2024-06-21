<?php

namespace App\Http\Requests;

use App\Utils\Enums\BemClassification;
use App\Utils\Enums\RedListClassification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFungiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inaturalist_taxa' => 'nullable|int|unique:fungi,inaturalist_taxa',
            'bem' => ['nullable', Rule::enum(BemClassification::class)],
            'kingdom' => 'nullable|string|max:255',
            'phylum' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'order' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'genus' => 'nullable|string|max:255',
            'specie' => 'nullable|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'authors' => 'nullable|string|max:255',
            'brazilian_type' => 'nullable|char:1',
            'brazilian_type_synonym' => 'nullable|char:2',
            'popular_name' => 'nullable|string|max:255',
            'threatened' => ['nullable', Rule::enum(RedListClassification::class)],
            'description' => 'nullable|string|max:255'
        ];
    }
}
