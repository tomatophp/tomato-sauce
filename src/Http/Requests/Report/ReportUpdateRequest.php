<?php

namespace TomatoPHP\TomatoSauce\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                        'page_name' => 'nullable|max:255|string',
            'report_name' => 'sometimes|max:255|string',
            'type' => 'sometimes|max:255|string',
            'sort' => 'sometimes',
            'table_name' => 'sometimes|max:255|string',
            'joins' => 'nullable',
            'conditions' => 'nullable',
            'aggregate' => 'nullable',
            'rows_count' => 'nullable',
            'fields' => 'nullable',
            'is_active' => 'sometimes'
        ];
    }
}
