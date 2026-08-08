<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;

/**
 * Base FormRequest for listing endpoints. Any invalid pagination/filter
 * parameter maps to the transversal GEN-4001 response, regardless of which
 * rule failed.
 */
abstract class ListRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return array_merge([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ], $this->filterRules());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function filterRules(): array
    {
        return [];
    }

    protected function refForFailedValidation(Validator $validator): array
    {
        return ['GEN-4001', 400, 'Los filtros de búsqueda no son válidos'];
    }

    public function page(): int
    {
        return (int) $this->integer('page', 1);
    }

    public function perPage(): int
    {
        return (int) $this->integer('per_page', 20);
    }
}
