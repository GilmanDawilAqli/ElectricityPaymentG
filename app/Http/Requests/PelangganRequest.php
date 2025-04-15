<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'NoKontrol' => 'required|string|max:12',
            'nama' => 'required|string|max:50',
            'telepon' => 'required|string:15',
            'Jenis_Plg' => 'required|string',
            'alamat' => 'required|string|max:150',
        ];
    }

    public function messages()
    {
        return [
            'NoKontrol.required' => 'No Kontrol is required.',
            'nama.required' => 'Nama is required.',
            'telepon.required' => 'Telepon is required.',
            'Jenis_Plg.required' => 'Jenis Pelanggan is required.',
            'alamat.required' => 'Alamat is required.',
        ];
    }
}
