<?php

namespace defyma\LaraRbac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRole
 *
 * @package defyma\LaraRbac\Http\Requests
 *
 * @author Andrey Girnik <girnikandrey@gmail.com>
 */
class UpdateRole extends FormRequest
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
        $id = $this->route('role')->id;
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:191',
                Rule::unique('roles')->where('id', '<>', $id),
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:191',
                Rule::unique('roles')->where('id', '<>', $id),
            ],
            'permissions' => 'required|array',
        ];
    }
}
