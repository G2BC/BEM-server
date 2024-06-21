<?php

namespace App\Http\Requests;

use App\Utils\Enums\StatesAcronyms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOccurrenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'state_acronym' => ['nullable', Rule::enum(StatesAcronyms::class)],
            'habitat' => 'nullable|string|max:255',
            'literature_reference' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'curation' => 'nullable|bool',
        ];
    }
}
