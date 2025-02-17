<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return response()->json(Enrollment::with(['course', 'student'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date',
        ]);

        $enrollment = Enrollment::create($request->all());

        return response()->json($enrollment, 201);
    }

    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment->load(['course', 'student']));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date',
        ]);

        $enrollment->update($request->all());

        return response()->json($enrollment);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json(['message' => 'Matrícula deletada com sucesso']);
    }

    public function studentsByCourse($courseId)
    {
        $students = Enrollment::where('course_id', $courseId)
            ->with('student') 
            ->get()
            ->pluck('student'); 

        if ($students->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum aluno encontrado para este curso.'
            ], 404);
        }

        return response()->json($students);
    }

    public function coursesByStudent($studentId)
    {
        $student = Student::find($studentId);
        if (!$student) {
            return response()->json([
                'message' => 'Aluno não encontrado.'
            ], 404);
        }

        $courses = Enrollment::where('student_id', $studentId)
            ->with('course') 
            ->get()
            ->map(function ($enrollment) {
                return $enrollment->course; 
            });

        if ($courses->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum curso encontrado para este aluno.'
            ], 404);
        }

        return response()->json($courses);
    }

}
