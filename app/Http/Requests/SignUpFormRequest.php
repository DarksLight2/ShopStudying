<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Worksome\RequestFactories\Concerns\HasFactory;

class SignUpFormRequest extends FormRequest
{

    use HasFactory;

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
        ]);
    }
}