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
            'waterproofing' => $this->waterproofingRules(),
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
        return [
            'steel_suppliers' => 'numeric|nullable',
        ];
    }

    public function masonryRules(): array
    {
        return [
            'masonry_suppliers' => 'nullable|numeric',
            'masonry_labour' => 'numeric|nullable',
            'supervision' => 'numeric|nullable',
            'several' => 'numeric|nullable',
            'scaffolding' => 'numeric|nullable',
            'mixer_and_equipment' => 'numeric|nullable',
        ];
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
        return [
            'labour' => 'nullable|numeric',
            'materials' => 'nullable|numeric',
            'hydropneumatic_system' => 'nullable|numeric',
            'automated_sprinkler' => 'nullable|numeric',
            'tank' => 'nullable|numeric',
            'basic_material' => 'nullable|numeric',
            'heater' => 'nullable|numeric',
            'bathroom' => 'nullable|numeric',
        ];
    }

    public function wiringRules(): array
    {
        return [
            'labour' => 'nullable|numeric',
            'lighting_fixtures_and_accessories' => 'nullable|numeric',
            'intercommunication' => 'nullable|numeric',
            'various_materials' => 'nullable|numeric',
        ];
    }

    public function kitchensRules(): array
    {
        return [
            'furniture' => 'numeric|nullable',
            'quartz_cover' => 'numeric|nullable',
            'suppliers' => 'numeric|nullable',
            'team' => 'numeric|nullable',
        ];
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
        return [
            'suppliers' => 'numeric|nullable',
            'materials' => 'numeric|nullable',
            'labour' => 'numeric|nullable',
        ];
    }

    public function paintingRules(): array
    {
        return [
            'suppliers' => 'numeric|nullable',
            'materials' => 'numeric|nullable',
            'labour' => 'numeric|nullable',
        ];
    }

    public function airconRules(): array
    {
        return [
            'air_conditioning_system' => 'nullable|numeric',
        ];
    }

    public function waterproofingRules(): array
    {
        return [
            'waterproofing' => 'numeric|nullable',
        ];
    }

    public function gardeningRules(): array
    {
        return [
            'plants_and_pots' => 'nullable|numeric',
            'suppliers' => 'nullable|numeric',
        ];
    }

    public function wallsRules(): array
    {
        return [
            'lightweight_prefabricated_walls' => 'nullable|numeric',
        ];
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
        return [
            'other_costs' => 'numeric|nullable',
        ];
    }

    public function operationRules(): array
    {
        return [
            'administration' => 'nullable|numeric',
            'accounting' => 'nullable|numeric',
            'legal' => 'nullable|numeric',
            'sales_suppliers' => 'nullable|numeric',
            'advertising_suppliers' => 'nullable|numeric',
            'tax_redial' => 'nullable|numeric',
        ];
    }
}
