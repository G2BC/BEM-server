<?php

namespace App\Http\Requests;

use App\Utils\Enums\StatesAcronyms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOccurrenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'state_acronym' => ['required', Rule::enum(StatesAcronyms::class)],
            'habitat' => 'required|string|max:255',
            'literature_reference' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }
}
