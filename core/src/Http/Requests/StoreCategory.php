<?php

namespace Leafr\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class StoreCategory extends Request
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

        $rules = [
            'name'             => 'required|string',
            'slug'              => 'required|unique:pages,slug',
            'parent_id'         => 'exists:categories,id',
        ];


        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules['slug'] = 'required|unique:categories,slug,'.$this->get('id');
                return $rules;
            }
            default:break;
        }
    }
}
