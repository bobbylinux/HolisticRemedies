<?php namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => '',
            'password' => '',
        ];
        //bypasso perchè gestisco le validazioni ne modello!
        /*return [
            'username' => 'required|email|unique:utenti',
            'password' => 'required|confirmed|min:8',
        ];*/
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}