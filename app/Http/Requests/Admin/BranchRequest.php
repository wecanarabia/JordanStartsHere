<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|min:4|max:255',
            'name_ar' => 'required|min:4|max:255',
            'partner_id'=>[ 'required', 'exists:partners,id'],
            'area_id'=>'required|exists:areas,id',
            'lat'=>'required|numeric',
            'long'=>'required|numeric',
            'location'=>'required|min:4|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'partner_id' => 'Partner',
            'area_id' => 'Area',
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
        ];
    }

}
