<?php

namespace Modules\RolesAndPermissions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRoleRequest extends FormRequest
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
            'role_name' => 'required|string'
        ];
    }
}
