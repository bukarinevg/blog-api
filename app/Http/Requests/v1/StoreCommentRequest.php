<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Comment;

class StoreCommentRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ];
    }

    // public function prepareForValidation(): void
    // {
    //     $data = [];

    //     foreach($this->all() as $obj){
    //         $obj['user_id'] = $obj['userId'] ?? null;
    //         $data[] = $obj;
    //     }
    //     $this->merge($data);
    // }

}
