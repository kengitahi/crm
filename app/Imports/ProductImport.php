<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ProductImport implements ToArray
{
    public static function fields(): array
    {
        return [
            ['id' => 'product_name', 'name' => __('modules.client.productName'), 'required' => 'Yes'],
            ['id' => 'price', 'name' => __('app.price'), 'required' => 'Yes'],
            ['id' => 'unit_type', 'name' => __('modules.unitType.unitType'), 'required' => 'No'],
            ['id' => 'product_category', 'name' => __('modules.productCategory.productCategory'), 'required' => 'No'],
            ['id' => 'product_sub_category', 'name' => __('modules.productCategory.productSubCategory'), 'required' => 'No'],
            ['id' => 'sku', 'name' => __('app.sku'), 'required' => 'No'],
            ['id' => 'description', 'name' => __('app.description'), 'required' => 'No'],
        ];
    }

    public function array(array $array): array
    {
        return $array;
    }
}
