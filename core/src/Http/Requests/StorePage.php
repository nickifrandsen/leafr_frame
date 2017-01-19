<?php

namespace Leafr\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class StorePage extends Request
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
            'title'             => 'required|string',
            'slug'              => 'required|unique:pages,slug',
            'parent_id'         => 'exists:pages,id',
            'show_in_menu'      => 'boolean'
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
                $rules['slug'] = 'required|unique:pages,slug,'.$this->get('id');
                return $rules;
            }
            default:break;
        }
    }
}
