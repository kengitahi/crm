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
            'licenses' => $this->licensesRules(),
            'urbanization' => $this->urbanizationRules(),
            'building' => $this->buildingRules(),
            'concrete' => $this->concreteRules(),
            'steel' => $this->steelRules(),
            'masonry' => $this->masonryRules(),
            'materials' => $this->materialsRules(),
            'finishes' => $this->finishesRules(),
            'plumbing' => $this->plumbingRules(),
            'wiring' => $this->wiringRules(),
            'kitchens' => $this->kitchensRules(),
            'Capentry' => $this->capentryRules(),
            'metalworking' => $this->metalworkingRules(),
            'painting' => $this->paintingRules(),
            'aircon' => $this->airconRules(),
            'waterproofing' => $this->waterprofingRules(),
            'gardening' => $this->gardeningRules(),
            'walls' => $this->wallsRules(),
            'additionalCosts' => $this->additionalCostsRules(),
            'otherCosts' => $this->otherCostsRules(),
            'operation' => $this->operationRules(),
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

    public function UrbanizationRules(): array
    {
        return [
            'urbanization_suppliers' => 'nullable|numeric',
        ];
    }

    public function BuildingRules(): array
    {
        return [];
    }

    public function ConcreteRules(): array
    {
        return [];
    }

    public function steelRules(): array
    {
        return [];
    }

    public function masonryRules(): array
    {
        return [];
    }

    public function materialsRules(): array
    {
        return [];
    }

    public function FinishesRules(): array
    {
        return [];
    }

    public function plumbingRules(): array
    {
        return [];
    }

    public function wiringRules(): array
    {
        return [];
    }

    public function kitchensRules(): array
    {
        return [];
    }

    public function CapentryRules(): array
    {
        return [];
    }

    public function metalworkingRules(): array
    {
        return [];
    }

    public function paintingRules(): array
    {
        return [];
    }

    public function airconRules(): array
    {
        return [
            'air_conditioning_system' => 'nullable|numeric',
        ];
    }

    public function waterproofingRules(): array
    {
        return [];
    }

    public function gardeningRules(): array
    {
        return [];
    }

    public function wallsRules(): array
    {
        return [];
    }

    public function additionalCostsRules(): array
    {
        return [];
    }

    public function otherCostsRules(): array
    {
        return [];
    }

    public function operationRules(): array
    {
        return [];
    }
}
