<?php

namespace App\Http\Requests;

use App\Models\Enrollment;
use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $alreadyEnrolled = Enrollment::where('course_id', $this->course_id)
                ->where('student_id', $this->student_id)
                ->exists();

            if ($alreadyEnrolled) {
                $validator->errors()->add('student_id', 'Este aluno já está matriculado neste curso.');
            }
        });
    }

    public function messages()
    {
        return [
            'course_id.required' => 'O campo curso é obrigatório.',
            'course_id.exists' => 'O curso informado não existe.',
            'student_id.required' => 'O campo aluno é obrigatório.',
            'student_id.exists' => 'O aluno informado não existe.',
            'enrollment_date.required' => 'O campo data da matrícula é obrigatório.',
            'enrollment_date.date' => 'A data da matrícula deve ser uma data válida.',
        ];
    }
}
