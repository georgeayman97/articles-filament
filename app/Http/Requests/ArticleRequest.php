<?php

namespace App\Http\Requests;

use App\Enums\ArticleStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

/**
 * @property string $name
 */
class ArticleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => [new Enum(ArticleStatus::class)],
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'author_id' => [
                'required',
                'integer',
                Rule::exists('authors', 'id'),
            ],
            'categories' =>'nullable'
        ];
    }
}
