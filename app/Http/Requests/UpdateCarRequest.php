<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'plate_number' => ['string','max:9', 'unique:cars,plate_number'],
            'owner' => ['string','max:100'],
            'model' => ['string','max:50'],
            'make' => ['string','max:50'],
            'performance' => ['integer'],
        ];
    }
}
