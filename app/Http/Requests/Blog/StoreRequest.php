<?php

namespace App\Http\Requests\Blog;

use App\Models\Category;
use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules(Category $category, Employee $employee)
    {
        $categoryId = $category->getTable();
        $employeeId = $employee->getTable();
        return [
            'title'         => "required|string|min:3|max:100",
            'slug'          => "unique:blogs,slug|string|required",
            'summary'       => "nullable|string",
            'date'          => "nullable|date",
            'content'       => "nullable|string",
            'show'          => "nullable|numeric|min:0|max:2",
            'category_id'   => "nullable|integer|exists:$categoryId,id",
            'employee_id'   => "nullable|integer|exists:$employeeId,id",
        ];
    }
}
