<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return response()->json(Enrollment::with(['course', 'student'])->get());
    }

    public function store(EnrollmentRequest $request)
    { 
        $enrollment = Enrollment::create($request->validated());
        return response()->json($enrollment, 201);
    }

    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment->load(['course', 'student']));
    }

    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());
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
