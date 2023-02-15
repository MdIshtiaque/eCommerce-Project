<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('testimonials', 'client_name')->whereNull('deleted_at'),

            ],
            //'client_name' => 'required|string|max:255|unique:testimonials,client_name',
            'client_designation' => 'required|string|max:255',
            'client_message' => 'required|string',
            'client_image' => 'nullable|image'
        ];
    }
}
