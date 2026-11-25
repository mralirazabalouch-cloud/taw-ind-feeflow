<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'monthly_fee' => 'required|numeric|min:0',
        ]);

        $student = new Student();
        $student->name = $validated['name'];
        $student->email = $validated['email'] ?? null;
        $student->phone = $validated['phone'] ?? null;
        $student->monthly_fee = $validated['monthly_fee'];
        $student->save();

        return redirect('/students')->with('success', 'Student added successfully!');
    }
}
