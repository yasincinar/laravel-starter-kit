<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Crypt;

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

    public function all()
    {
        $data = collect(parent::all());

        if ($data->has('id') && $data->get('id') != '') {
            $data['id'] = Crypt::decrypt($data['id']);
        }
        return $data->toArray();
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
