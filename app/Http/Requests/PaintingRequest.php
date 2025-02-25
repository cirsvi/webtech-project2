<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaintingRequest extends FormRequest
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
            'title' => 'required|min:3|max:256',
            'artist_id' => 'required',
            'style_id' => 'required',
            'location_id' => 'required',
            'description' => 'nullable',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'artist_id' => 'gleznotājs/-a',
            'style_id' => 'stils',
            'location_id' => 'lokācija',
            'description' => 'apraksts',
            'year' => 'gads',
            'image' => 'attēls',
            'display' => 'publicēt',
        ];
    }
}
