<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
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
        switch ($this->method()){
            case 'PUT': 
                return [
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                    'user_id' => 'required|exists:users,id',
                    'type' => 'required|in:' . implode(',', [Post::TYPE_PRIVATE, Post::TYPE_PUBLIC]),
                ];
            case 'PATCH':
                //here we add sometimes to make the fields optional
                return [
                    'title' => 'required|sometimes|string|max:255',
                    'content' => 'required|sometimes|string',
                    'user_id' => 'required|sometimes|exists:users,id',
                    'type' => 'required|sometimes|in:' . implode(',', [Post::TYPE_PRIVATE, Post::TYPE_PUBLIC]),
                ];
           
        }
        return [];
        
    }

    public function prepareForValidation(): void
    {
        if($this->userId){
            $this->merge([
                'user_id' => $this->userId,
            ]);
        }
    }

}
