<?php

namespace Leafr\Commerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class StoreProduct extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_type_id'   => 'required|exists:product_types,id',
            'name'              => 'required|string',
            // 'slug'              => 'required|unique:products,slug,id',
            // 'sku'               => 'required|unique:products,sku,',
            'unit_price'        => 'required|numeric',
            'cost_price'        => 'numeric|nullable',
            'sale_price'        => 'numeric|nullable',
            'weight'            => 'numeric|nullable',
            'brand_id'          => 'exists:brands,id',
            'supplier_id'       => 'exists:suppliers,id',
            'is_online'         => 'boolean'
        ];
    }
}
