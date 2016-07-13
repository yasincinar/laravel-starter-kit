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

        if ($data->has('user_id') && $data->get('user_id') != '') {
            $data['user_id'] = Crypt::decrypt($data['user_id']);
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


        switch ($this->getMethod()) {
            case 'POST':
                $rules['first_name'] = 'required|alpha_dash|min:3|max:255';
                $rules['last_name'] = 'required|alpha_dash|min:3|max:255';
                $rules['slug'] = 'required|alpha_dash|min:3|max:255|unique:users,slug';
                $rules['email'] = 'required|email|unique:users,email';
                $rules['cell_phone'] = 'required|size:11|unique:users,cell_phone';
                $rules['address'] = 'required|min:3|max:65535';
                $rules['city'] = 'required|between:1,82';
                $rules['role'] = 'required';
                $rules['password'] = 'required|alpha_dash|confirmed';

                return $rules;

                break;
            case 'PUT':

                $userId = Crypt::decrypt($this->get('user_id'));
                $rules['first_name'] = 'required|alpha_dash|min:3|max:255';
                $rules['last_name'] = 'required|alpha_dash|min:3|max:255';
                $rules['slug'] = 'required|alpha_dash|min:3|max:255|unique:users,slug,' . $userId;
                $rules['email'] = 'required|email|unique:users,email,' . $userId;
                $rules['cell_phone'] = 'required|size:11|unique:users,cell_phone,' . $userId;
                $rules['address'] = 'required|min:3|max:65535';
                $rules['city'] = 'required|between:1,82';
                $rules['role'] = 'required';

                if ($this->has('password'))
                    $rules['password'] = 'required|alpha_dash|confirmed';

                return $rules;

                break;
        }

    }
}
