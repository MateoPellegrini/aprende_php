<?php
// app/Http/Requests/LeccionRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeccionRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->can('admin'); }

    public function rules(): array
    {
        return [
            'tema_id'     => ['required','exists:temas,id'],
            'orden'       => ['nullable','integer','min:1'],
            'titulo'      => ['required','string','max:255'],
            'descripcion' => ['nullable','string'],
            'estado'      => ['sometimes','boolean'], // visible/oculta
        ];
    }
}
