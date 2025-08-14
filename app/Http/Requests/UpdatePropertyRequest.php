<?php

namespace App\Http\Requests;

use App\Enums\PropertyCategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'category' => [
                'required',
                'string',
                Rule::in(PropertyCategory::values())
            ],
            'ownersName' => 'required | string',
            'location' => 'required | string',
            'propertyValuation' => 'required | numeric',
            'existingImages' => 'sometimes | array',
            'imagesToDelete' => 'sometimes | array',
            'images' => [
                'sometimes',
                'array',
                function($attribute, $value, $fail){

                     $newImagesCount = is_array($value) ? count($value) : 0;

                     $existingImagesCount = is_array($this->existingImages) ? count($this->existingImages) : 0;

                     $totalImagesCount = $newImagesCount + $existingImagesCount;

                    if($totalImagesCount !== 3){
                        $fail('You must upload exactly 3 images, no more, no less.');
                    }
                }
            ],
            'images.*' => 'image | mimes:jpeg, png, jpg | max:10240',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'You must select the category of the property',
            'ownersName.required' => 'You must enter the name of the owner of the property',
            'location.required' => 'You must enter the location of the property',
            'propertyValuation.required' => 'You must enter the price of the property',

            'images.array' => 'Invalid format of the images',

            'images.0.required' => 'The first property image is required',
            'images.0.image' => 'The first new image you selected must be a valid image',
            'images.0.mimes' => 'The first new image you selected image must be in JPEG, PNG, JPG or WebP format.',
            'images.0.max' => 'The first new image you selected must not exceed 10MB in size',

            'images.1.required' => 'The second property image is required',
            'images.1.image' => 'The second new image you selected must be a valid image',
            'images.1.mimes' => 'The second new image you selected image must be in JPEG, PNG, JPG or WebP format.',
            'images.1.max' => 'The second new image you selected must not exceed 10MB in size',

            'images.2.required' => 'The third property image is required',
            'images.2.image' => 'The third new image you selected must be a valid image',
            'images.2.mimes' => 'The third new image you selected image must be in JPEG, PNG, JPG or WebP format.',
            'images.2.max' => 'The third new image you selected must not exceed 10MB in size'
        ];
    }
}
