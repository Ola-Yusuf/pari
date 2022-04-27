<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Crypt;
use Auth;
use App\Rules\Alpha_spaces;
use App\Rules\Email;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'fname' => ['required', 'string', 'max:255', new Alpha_spaces()],
            'username' => 'sometimes|nullable|string|max:255|alpha_dash|unique:clients,id,'.Crypt::decrypt($this->clientId),
            'email' => ['required', 'string', 'email',new Email(),'max:255', 'unique:clients,id,'.Crypt::decrypt($this->clientId)],
            'tel' => 'required|numeric|max:9999999999999999|unique:clients,id,'.Crypt::decrypt($this->clientId),
            'address' => 'sometimes|nullable',
            'gender' => 'required|string',
            'avatar' => 'sometimes|mimes:jpeg,jpg,png,gif',
        ];
    }
}
