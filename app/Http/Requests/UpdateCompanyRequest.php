<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Company;
use App\Models\User;

class UpdateCompanyRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique(Company::class)->ignore($this->route('company')->id)],
            'ceo' => ['sometimes', 'required', 'string', 'max:255'],
            'address' => ['sometimes', 'required', 'string', 'max:255'],
            'website' => ['sometimes', 'required', 'string', 'max:255', Rule::unique(Company::class)->ignore($this->route('company')->id)],
            'phone' => ['sometimes', 'required', 'string', 'max:20', Rule::unique(Company::class)->ignore($this->route('company')->id)],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->route('company')->id)],
            'password' => ['sometimes', 'required', 'string', 'max:20'],
        ];
    }
}
