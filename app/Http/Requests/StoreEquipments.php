<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipments extends FormRequest
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
            //
            'serial' => 'required|unique:equipments|max:255',
            'type' => 'required|max:255',
            'department_id' => 'required',
            'brand_id' => 'required',
        ];
    }


    /**
     * 
     *   Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'serial.required' => 'Campo Requerido',
            'serial.unique'  => 'Serial Registrado',
            'type' => 'Campo Requerido',
            'department_id' => 'Campo Requerido',
            'brand_id' => 'Campo Requerido',
        ];
    }

}
