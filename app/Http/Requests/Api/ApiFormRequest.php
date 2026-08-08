<?php

namespace App\Http\Requests\Api;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Base FormRequest for the JSON API. Splits validation into two phases,
 * matching the error-dictionary convention documented in openapi-vitalia.yaml:
 *
 * 1. `rules()` — structural checks (required/type). Failures here throw an
 *    ApiException chosen by `refForFailedValidation()` (400 by default).
 * 2. `afterValidation()` — business-rule checks (format, ranges, enums,
 *    catalog existence, conflicts). Each subclass throws the exact
 *    ApiException (422/404/409) for the first rule it violates.
 */
abstract class ApiFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): never
    {
        [$ref, $status, $msg] = $this->refForFailedValidation($validator);

        throw new ApiException($ref, $msg, $status, ['errors' => $validator->errors()]);
    }

    /**
     * @return array{0: string, 1: int, 2: string}
     */
    protected function refForFailedValidation(Validator $validator): array
    {
        return ['VAL-1001', 400, 'Revisa los datos enviados'];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            // Laravel always runs `after()` callbacks, even when earlier rules
            // already failed. Business-rule checks assume structurally valid
            // input, so skip them until the required/type checks are clean.
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $this->afterValidation($validator);
        });
    }

    /**
     * Business-rule checks. Override and throw ApiException on the first
     * violated rule.
     */
    protected function afterValidation(Validator $validator): void
    {
        //
    }
}
