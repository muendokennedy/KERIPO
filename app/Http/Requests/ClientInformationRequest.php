<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'fullName' => 'required | string',
            'email' => 'required | string',
            'birthDate' => 'required | date',
            'mobileNumber' => 'required | numeric',
            'gender' => 'required | string',
            'occupation' => 'required | string',
            'identityDocument' => 'required | string',
            'idNumber' => 'required | numeric',
            'issueLocation' => 'required | string',
            'expiryDate' => 'required | date',
            'countryIssued' => 'required | string',
            'issueAuthority' => 'required | string',
            'county' => 'required | string',
            'subCounty' => 'required | string',
            'ward' => 'required | string',
            'postalCode' => 'required | string',
            'address' => 'required | string',
            'town' => 'required | string',
            'propertyId' => ['required', 'numeric', Rule::in(Property::pluck('propertyId')->toArray())]
        ];
    }
}
