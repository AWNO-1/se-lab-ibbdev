<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'image' => 'nullable|image|max:2048',
            'image_path' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان السؤال مطلوب',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.max' => 'العنوان لا يجب أن يتجاوز 255 حرفاً',
            'body.required' => ' جسم السؤال مطلوب',
            'body.string' => 'يجب أن يكون الجسم نصاً',
            'body.min' => ' يجب أن يتجاوز الجسم 10 أحرف',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
            'image_path.image' => 'الملف يجب أن يكون صورة',
            'image_path.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
        ];
    }
}
