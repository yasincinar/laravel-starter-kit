<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Crypt;

class UserRequest extends Request
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

        if ($data->has('cell_phone') && $data->get('cell_phone') != '') {
            $data['cell_phone'] = preg_replace('/[^0-9]/', '', $data['cell_phone']);
        }

        if ($data->has('city') && $data->get('city') != '') {
            $data['city'] = Crypt::decrypt($data['city']);
        }

        if ($data->has('role') && $data->get('role') != '') {
            $data['role'] = Crypt::decrypt($data['role']);
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
        return [
            'first_name' => 'required|alpha_dash|min:3|max:255',
            'last_name' => 'required|alpha_dash|min:3|max:255',
            'slug' => 'required|alpha_dash|min:3|max:255',
            'email' => 'required|email',
            'cell_phone' => 'required|size:11',
            'address' => 'required|min:3|max:65535',
            'city' => 'required|between:1,82',
            'role' => 'required',
            'password' => 'required|alpha_dash|confirmed',
        ];
    }
}
