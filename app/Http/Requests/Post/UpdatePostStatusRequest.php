<?php

namespace App\Http\Requests\Post;

use App\Enums\Statuses;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->post->user_id &&  ( $this->post->user_id == auth('api')->user()->id)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                 Rule::in([Statuses::Active->value, Statuses::Draft->value])
            ],

        ];
    }
}
