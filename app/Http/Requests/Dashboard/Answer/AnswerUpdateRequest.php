<?php

namespace App\Http\Requests\Dashboard\Answer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AnswerUpdateRequest extends FormRequest
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
            'question_id' => 'sometimes|exists:questions,id',
            'text' => 'sometimes|string|max:255',
            'is_correct' => 'sometimes|boolean',
        ];
    }
}
