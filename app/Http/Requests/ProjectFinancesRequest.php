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
            'capentry' => $this->capentryRules(),
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

    public function licensesRules(): array
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

    public function urbanizationRules(): array
    {
        return [
            'urbanization_suppliers' => 'nullable|numeric',
        ];
    }

    public function buildingRules(): array
    {
        return [];
    }

    public function concreteRules(): array
    {
        return [
            'concrete_suppliers' => 'nullable|numeric',
        ];
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
        return [
            'rod_wire_armex' => 'nullable|numeric',
            'prefabricated_systems' => 'nullable|numeric',
            'cement_mortar' => 'nullable|numeric',
            'premixed_concrete' => 'nullable|numeric',
            'block_and_brick' => 'nullable|numeric',
            'basic_material' => 'nullable|numeric',
            'sand_and_material_freight' => 'nullable|numeric',
            'waterproofing' => 'nullable|numeric',
            'miscellaneous' => 'nullable|numeric',
        ];
    }

    public function finishesRules(): array
    {
        return [
            'wooden_stairs' => 'nullable|numeric',
            'marble_and_granites' => 'nullable|numeric',
            'wooden_stave' => 'nullable|numeric',
            'wall_covering' => 'nullable|numeric',
            'kitchens' => 'nullable|numeric',
            'carpentry' => 'nullable|numeric',
            'bathroom_furniture' => 'nullable|numeric',
            'outdoor_areas' => 'nullable|numeric',
            'marble_slabs' => 'nullable|numeric',
            'floors' => 'nullable|numeric',
            'finishes_labour' => 'nullable|numeric',
            'finishes_suppliers' => 'nullable|numeric',
        ];
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

    public function capentryRules(): array
    {
        return [
            'locks_and_fittings' => 'nullable|numeric',
            'closet_bathroom_stairs' => 'nullable|numeric',
            'capentry_suppliers' => 'nullable|numeric',
        ];
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
        return [
            'imss' => 'numeric|nullable',
            'infornavit' => 'numeric|nullable',
            'accounting' => 'numeric|nullable',
        ];
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
