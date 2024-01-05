<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        if(request()->isMethod('post')) {
            return[
                'image' => 'required | image | mimes:jpeg, png, jpg, gif | max:2048'
            ];
        }else {
            return [
                'image' => 'required | image | mimes:jpeg, png, jpg, gif | max:2048'
            ];
        }
        
    }

    /**
     * Custom message for validation
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        
        if(request()->isMethod('post')) {
            return[
                'image.required' => 'Image is required!'
            ];
        }
        
    }

}
