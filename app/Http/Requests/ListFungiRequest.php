<?php

namespace App\Http\Requests;

use App\Utils\Enums\BemClassification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListFungiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'taxonomy' => 'required|max:255|string',
            'stateAc' => 'nullable|string|max:2',
            'bem' => ['nullable', Rule::enum(BemClassification::class)],
            'biome' => 'nullable|string|max:255'
        ];
    }
}
