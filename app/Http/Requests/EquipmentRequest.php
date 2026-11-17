<?php

namespace App\Http\Requests;
use App\Models\Equipment;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
        'equipment_name'      => ['required', 'string', 'max:255'],
        'category'            => ['required', Rule::in(Equipment::CATEGORIES)],
        'unit_price'          => ['required', 'numeric', 'min:0'],
        'description'         => ['required', 'string'],
        'availability_status' => ['required', Rule::in(Equipment::STATUSES)],
    ];
}

    public function messages(): array
{
    return [
        'equipment_name.required' => 'Please enter the equipment name.',
        'unit_price.numeric'      => 'Unit price must be a number.',
        'unit_price.min'          => 'Unit price cannot be negative.',
        'category.in'             => 'Choose Paddles, Balls, Nets, or Accessories.',
    ];
}
}
