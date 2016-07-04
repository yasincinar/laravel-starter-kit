<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class GroupRequest extends Request
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
        switch ($this->method()) {
            // Create
            case 'POST':
                // rules
                $rules['role_name'] = 'required|unique:roles,name';

                if(!count($this->permissions)) //if permission count equal zero
                    $rules['permissions'] = "required";

                return $rules;
                break;

            // Update
            case 'PUT':
                // rules
                $rules['role_name'] = 'required|unique:roles,name,' .\Crypt::decrypt($this->get('id'));

                if(!count($this->permissions)) //if permission count equal zero
                    $rules['permissions'] = "required";

                return $rules;
                break;
        }
    }
}
