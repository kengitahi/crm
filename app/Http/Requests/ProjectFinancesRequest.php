<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFinancesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $formType = $this->input('form_type');

        return match ($formType) {
            'licenses' => $this->LicensesRules(),
            default => [],
        };
    }

    public function LicensesRules(): array
    {
        return [
            'who' => 'nullable|numeric',
            'cfe' => 'nullable|numeric',
            'condominium_regime' => 'nullable|numeric',
            'license_and_alignment' => 'nullable|numeric',
            'rooms' => 'nullable|numeric',
            'mobility' => 'nullable|numeric',
        ];
    }
}
